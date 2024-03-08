<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Message\MerchantMsg;

class TixianController extends BaseController
{
	protected MessageBusInterface $bus;
	protected EntityManagerInterface $entityManager;
	
	public function __construct(EntityManagerInterface $_entityManager,MessageBusInterface $_bus)
	{
		$this->bus = $_bus;
		$this->entityManager = $_entityManager;
	}
	
    #[Route('/tixian.api', name: 'tixian')]
    public function index(Request $request)
    {
		$this->dispatch($request);
    }
	
	public function _list($request)
	{
		$user = $this->user($request);
		$merchant = $this->findMerchantByUid($user->getId());
		$show_filter = $request->request->get('show_filter','');
		
		$where = ' where mid='.$merchant->getId();
		
        $logs = $this->pager($request,'*','tixian',$where);
		
		foreach($logs['rows'] as &$row)
		{
			$row['created_at'] = date('Y-m-d H:i:s',$row['created_at']);
			$row['exec_at'] = date('Y-m-d H:i:s',$row['exec_at']);
		}
        
		$this->console(['logs'=>$logs,'banlace'=>$merchant->getAmount()]);
	}
	
	//提交
	public function _create($request)
	{
		$user = $this->user($request);
		$merchant = $this->findMerchantByUid($user->getId());
		if(!$merchant)
		{
			$this->e('merchant not exist!');
		}
		
		if(1 != $merchant->isIsActive())
		{
			$this->e('商户未激活,无法提现');
		}
		if(0 != $merchant->isIsTest())
		{
			$this->e('测试商户无法提现');
		}
		
		$amount = $request->request->get('amount','');
		$wallet = $request->request->get('wallet','');
		$note   = $request->request->get('note','');
		$ip     = $this->GetIp();
		
		if(is_numeric($amount) && $amount > 0)
		{
			//do nothing
		}
		else
		{
			$this->e('金额错误');
		}
		
		//金额是不是充足
		if($amount > $merchant->getAmount())
		{
			$this->e('余额不足，发起金额:'.$amount.', 账户余额:'.$merchant->getAmount());
		}
		
		//加入消息队列
		$this->bus->dispatch(new MerchantMsg(json_encode(['action'=>'TIXIAN','merchant_id'=>$merchant->getId(),'amount'=>$amount,'wallet'=>$wallet,'note'=>$note,'ip'=>$ip])));
		
		$this->succ('已创建');
	}
	
}
