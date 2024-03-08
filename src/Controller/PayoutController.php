<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PayoutController extends BaseController
{

    #[Route('/payout.api', name: 'payout')]
    public function index(Request $request): JsonResponse
    {
        return $this->dispatch($request);
    }
	
	public function _load_setting($request): JsonResponse
	{
		$bundle = $request->request->get('bundle','PAYOUT');
		
		$user = $this->user($request);
		$merchant = $this->findMerchantByUid($user->getId());
		
		$api = $this->getParameter('paycenter').'/api/channel';
		$data = [
			'action'=>'fetch',
			'appid'=>$merchant->getPayoutAppid(),
			'bundle'=>strtoupper($bundle),
			'time'=>time(),
		];
		$data['sign'] = $this->_hash_hmac($data,$merchant->getPayoutSecret());
		$ret = $this->post_form($api,$data);
		if(0 == $ret[0])
		{
			$this->e("载入通道配置出错");
		}
		else
		{
			echo $ret[1];
			die();
		}
	}
	
	public function _create($request)
	{
		$user = $this->user($request);
		$merchant = $this->findMerchantByUid($user->getId());
		
		$amount = $request->request->get('amount','');
		$google_code = $request->request->get('google_code','');
		$channel_id = $request->request->get('channel_id',0);
		
		if(is_numeric($amount) && $amount > 0)
		{
			//
		}
		else
		{
			$this->e('金额错误!');
		}
		if(is_numeric($channel_id) && $channel_id > 0)
		{
			//
		}
		else
		{
			$this->e('通道id必须为数字!');
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
		
		$user = $this->user($request);
		$merchant = $this->findMerchantByUid($user->getId());
		
		$merchant_channel = $this->db(\App\Entity\MerchantChannel::class)->findOneBy(['cid'=>$channel_id,'mid'=>$merchant->getId()]);
		if(!$merchant_channel)
		{
			$this->e('通道配置不存在:'.$merchant->getId().':'.$channel_id);
		}
		
		//组装参数 提交给支付中心
		$post_data = [];
		$drop_keys = ['google_code','channel_id','action'];
		foreach($_POST as $k=>$v)
		{
			if('_' != substr($k,0,1) && !in_array($k,$drop_keys))
			{
				$post_data[$k] = $v;
			}
		}
		
		$order_no = 'MHO'.md5($merchant->getPayoutAppid().microtime());
		
		$notify_url = $this->generateUrl('api_notify',['order_no'=>$order_no],UrlGeneratorInterface::ABSOLUTE_URL);
		$notify_url = str_replace('http:','https:',$notify_url);
		
		$post_data['appid'] = $merchant->getPayoutAppid();
		$post_data['order_no'] = $order_no;
		$post_data['notify_url'] = $notify_url;
		$post_data['version'] = '2.0';
		
		$timestamp = time();
		$post_data['timestamp'] = $timestamp;
		$post_data['version'] = '2.0';
		
		//增加version字段，修改签名字段
		$sign_data = ['appid'=>$post_data['appid'],'order_no'=>$post_data['order_no'],'amount'=>$post_data['amount'],'timestamp'=>$timestamp,'version'=>'2.0'];
		
		$sign = md5($this->_ascii_params($sign_data).'&key='.$merchant->getPayoutSecret());
		$post_data['sign'] = $sign;
		
		//提交给API
		$ret = $this->post_json($this->getParameter('paycenter').'/api/payout/order/create',$post_data);
		
		if(!array($ret))
		{
			$this->e('http error! ret not an array! errCode:60159');
		}
		if(200 != $ret[0])
		{
			$this->e('pay api return not 200,content:'.$ret[1]);
		}
		$data = $ret[1];print_r($data);die();
		if('' == $data)
		{
			$this->e('An error occurred, empty payment result!');
		}
		
		$data = json_decode($data,true);
		if(count($data) < 2 || !array_key_exists('code',$data))
		{
			echo json_encode(['code'=>-1,'msg'=>'An error occurred, invalidate result dataArray!','ret'=>$ret]);
			die();
		}
		
		if(0 != $data['code'])
		{
			$err = ['code'=>$data['code'],'msg'=>$data['msg']];
			echo json_encode($err);
			die();
		}
		
		echo $ret[1];
		die();
	}

	//载入需要的字段
	public function _load_meta($request)
	{
		$user = $this->user($request);
		$merchant = $this->findMerchantByUid($user->getId());
		
		$api = $this->getParameter('paycenter').'/api/channel';
		$data = [
			'action'=>'fetch',
			'appid'=>$merchant->getPayoutAppid(),
			'bundle'=>'PAYOUT',
			'time'=>time(),
		];
		$data['sign'] = $this->_hash_hmac($data,$merchant->getPayoutSecret());
		$ret = $this->post_form($api,$data);		
		$data = json_decode($ret[1],true);
		$columns = $data['columns'];
		array_unshift($columns,['key'=>"amount",'text'=>"金额"]);
		echo json_encode([
			'code'=>0,
			'msg'=>'OK',
			'columns'=>$columns,
		]);
		die();
	}
	
}


