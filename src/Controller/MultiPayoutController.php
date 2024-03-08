<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Message\MerchantMsg;

class MultiPayoutController extends BaseController
{
	
	protected MessageBusInterface $bus;
	protected EntityManagerInterface $entityManager;
	
	public function __construct(EntityManagerInterface $_entityManager,MessageBusInterface $_bus)
	{
		$this->bus = $_bus;
		$this->entityManager = $_entityManager;
	}

    #[Route('/multi_payout.api', name: 'multi_payout_api')]
    public function index(Request $request): JsonResponse
    {
        return $this->dispatch($request);
    }
	
	public function _load_pager($request)
	{
		$user = $this->user($request);
		$merchanat = $this->findMerchantByUid($user->getId());
		
        $rows = $this->pager($request,'*','multi_payout',' where mid='.$merchanat->getId());
		foreach($rows['rows'] as &$row)
		{
			$row['request_token'] = $this->authcode('ID:'.$row['id']);
			$row['created_at'] = date('Y-m-d H:i:s',$row['created_at']);
		}
        
		$this->console($rows);
	}
	
	public function _show_multi_detail($request)
	{
		$pid = $this->GetId($request->request->get('request_token',''));

        $rows = $this->pager($request,'*','multi_payout_orders',' where pid='.$pid);
		foreach($rows['rows'] as &$row)
		{
			$row['data'] = json_decode($row['data'], true);
		}
        
		$this->console($rows); 
	}
	
	public function _send($request): JsonResponse
	{
		$column = $request->request->get('column','');
		$data = $request->request->get('data','');
		$google_code = $request->request->get('google_code','');
		
		if(trim($data) < 1)
		{
			$this->e("提交数据为空");
		}
		
		$user = $this->user($request);
		$merchant = $this->findMerchantByUid($user->getId());
		
		//判断IP白名单和余额+手续费
		$request_ip = $this->GetIp();
		$ip_table = $this->db(\App\Entity\IpTable::class)->findOneBy(['ip'=>$request_ip,'mid'=>$merchant->getId()]);
		if(!$ip_table)
		{
			$this->e('IP不在白名单:['.$request_ip.']');
		}
		if(!$ip_table->isIsActive())
		{
			return new JsonResponse(['code' => -7011,'msg'=>'IP被禁止操作:['.$request_ip.']']);
		}
		
		if(is_numeric($google_code) && $google_code > 0)
		{
			if(6 != strlen($google_code))
			{
				$this->e('谷歌验证码必须6位数字');
			}
			
			//开始验证关键谷歌是不是正确
			$bind = (int)$merchant->isVipGoogleBinded();
			if(0 == $bind)
			{
				$this->e('请先绑定关键谷歌');
			}
			$google_secret = $merchant->getVipGoogleSecret();
			if('' == $google_secret)
			{
				$this->e($user->getId().':谷歌密钥为空，请刷新页面后重试');
			}
			$google_authenticator = new \App\Utils\GoogleAuthenticator();
			$checkResult = $google_authenticator->verifyCode($google_secret, $google_code, 2);
			if (!$checkResult)
			{
				$this->e('谷歌验证码错误');
			}
		}
		else
		{
			$this->e('谷歌验证码必须为6位数字!');
		}
		
		//获取默认通道
		$merchant_channel = $this->db(\App\Entity\MerchantChannel::class)->findOneBy(['bundle'=>'PAYOUT','mid'=>$merchant->getId(),'is_default'=>1]);
		if(!$merchant_channel)
		{
			echo json_encode(['code' => -7103,'msg'=>'未配置默认通道']);die();
		}
		
		$channel = $this->db(\App\Entity\Channel::class)->find($merchant_channel->getCid());
		if(!$channel)
		{
			return new JsonResponse(['code' => 7016,'msg'=>'CHANNEL_NOT_EXISTS:'.$merchant_channel->getCid()]);
		}
		if(1 != $channel->isIsActive())
		{
			return new JsonResponse(['code' => 7017,'msg'=>'CHANNEL_NOT_ACTIVED:'.$channel->getId()]);
		}
		
		$_columns = json_decode($column,true);
		$data = str_replace('\r\n','\n',$data);
		$datas = preg_split("/\n/",$data);
		
		$columns = [];
		foreach($_columns as $_c)
		{
			$columns[] = $_c['key'];
		}
		
		$total_count = count($datas);
		$total_amount = 0;
		
		$total_channel_fee = 0;
		
		$channel_require_data = [];
		foreach($datas as $row)
		{
			if(substr_count($row, '|') != count($columns)-1)
			{
				$this->e('格式错误:'.$row);
			}
			$cells = explode('|',$row);
			$crd = [];
			foreach($cells as $idx=>$cell)
			{
				$crd[$columns[$idx]] = trim($cell);
			}
			
			$amount = (float)trim($cells[0]);
			$total_channel_fee += ($amount + $amount * (float)($merchant_channel->getPct()/100) + (float)$merchant_channel->getSf());
			
			$total_amount = $total_amount + $amount;
			$channel_require_data[] = $crd;
		}
		
		//要判断余额是不是可以发起这么多的代付
		if(1 == $merchant->isIsTest())
		{
			if($merchant->getTestAmount() < $total_channel_fee)
			{
				$this->e('当前测试余额:'.$merchant->getTestAmount().'小于：'.$total_channel_fee.',不足以发起批量代付!');
			}
		}
		else
		{
			if($merchant->getAmount() < $total_channel_fee)
			{
				$this->e('当前余额:'.$merchant->getAmount().'小于：'.$total_channel_fee.',不足以发起批量代付!');
			}
		}
		
		//入库
		$multi_payout = new \App\Entity\MultiPayout();
		$multi_payout->setTotalCount($total_count);
		$multi_payout->setTotalAmount($total_amount);
		$multi_payout->setStatus('');
		$multi_payout->setUpdatedAt(0);
		$multi_payout->setCompleteAt(0);
		$multi_payout->setGeneratedCount(0);
		$multi_payout->setGeneratedAmount(0);
		$multi_payout->setSuccCount(0);
		$multi_payout->setSuccAmount(0);
		$multi_payout->setCreatedAt(time());
		$this->save($multi_payout);
		
		if(is_numeric($multi_payout->getId()) && $multi_payout->getId() > 0)
		{
			//save ok , do nothing
		}
		else
		{
			$this->e('批量代付保存数据失败');
		}
		$paycenter = $this->getParameter('paycenter').'/api/payout/order/create';
		foreach($channel_require_data as &$pd)
		{
			$pd['appid'] = $merchant->getPayoutAppid();
			$pd['order_no'] = 'MUO'.md5($merchant->getPayoutAppid().microtime());
			
			$notify_url = $this->generateUrl('api_notify',['order_no'=>$pd['order_no']],UrlGeneratorInterface::ABSOLUTE_URL);
			$notify_url = str_replace('http:','https:',$notify_url);
			$notify_url = str_replace('https:','http:',$notify_url);
			
			$pd['notify_url'] = $notify_url;
			
			$sign = md5($this->_ascii_params($pd).'&key='.$merchant->getPayoutSecret());
			$pd['sign'] = $sign;
			
			$mpo = new \App\Entity\MultiPayoutOrders();
			$mpo->setPid($multi_payout->getId());
			$mpo->setPno('');
			$mpo->setMno($pd['order_no']);
			$mpo->setErrCode('');
			$mpo->setErrMsg('');
			$mpo->setData(json_encode($pd));
			$this->save($mpo);
			
			if($mpo->getId() > 0)
			{
				$this->bus->dispatch(new MerchantMsg(json_encode(['action'=>'MULTI_PAYOUT_CREATED','paycenter'=>$paycenter,'mpo_id'=>$mpo->getId()])));
				//$util_payout = new \App\Utils\UtilPayout();
				//$util_payout->dispatch($this->entityManager,json_encode(['action'=>'MULTI_PAYOUT_CREATED','paycenter'=>$paycenter,'mpo_id'=>$mpo->getId()]));
			}
		}
		
		echo json_encode(['code'=>0,'msg'=>'已提交,处理中']);
		die();
	}
}


