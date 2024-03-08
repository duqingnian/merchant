<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends BaseController
{

    #[Route('/home.api', name: 'home')]
    public function index(Request $request): JsonResponse
    {
        return $this->dispatch($request);
    }
	
	public function _data($request): JsonResponse
	{
		$user = $this->user($request);
		$merchant = $this->findMerchantByUid($user->getId());
		
		$today = $this->_get_today();
		$yesterday = $this->_get_yesterday();
		
		$data = [
			'list'=>[
				'dates'=>[],
				'payin_count'=>[],
				'payout_count'=>[],
				'payin_amount'=>[],
				'payout_amount'=>[],
			],
			'payin'=>[
				'today'=>['amount'=>0,'count'=>0],
				'yesterday'=>['amount'=>0,'count'=>0],
				'total'=>['amount'=>0,'count'=>0]
			],
			'payout'=>[
				'today'=>['amount'=>0,'count'=>0],
				'yesterday'=>['amount'=>0,'count'=>0],
				'total'=>['amount'=>0,'count'=>0]
			],
		];
		
		for($i=6;$i>=0;$i--)
		{
			$T = time() - $i*86400;
			
			$time1 = strtotime(date('Y-m-d',$T).' 0:0:0');
			$time2 = strtotime(date('Y-m-d',$T).' 23:59:59');

			$data['list']['dates'][] = date('Y-m-d',$T);
			$data['list']['payin_count'][] = $this->_get_count($merchant,'payin',$time1,$time2);
			$data['list']['payin_amount'][] = $this->_get_amount($merchant,'payin',$time1,$time2);
			$data['list']['payout_count'][] = $this->_get_count($merchant,'payout',$time1,$time2);
			$data['list']['payout_amount'][] = $this->_get_amount($merchant,'payout',$time1,$time2);
		}

		//今日收款
		$data['payin']['today']['amount'] = $this->_get_amount($merchant,'payin',$today[0],$today[1]);
		$data['payin']['today']['count'] = $this->_get_count($merchant,'payin',$today[0],$today[1]);
		
		//昨日收款总额
		$data['payin']['yesterday']['amount'] = $this->_get_amount($merchant,'payin',$yesterday[0],$yesterday[1]);
		$data['payin']['yesterday']['count'] = $this->_get_count($merchant,'payin',$yesterday[0],$yesterday[1]);
		
		//收款总额
		$data['payin']['total']['amount'] = $this->_get_amount($merchant,'payin',0,time());
		$data['payin']['total']['count'] = $this->_get_count($merchant,'payin',0,time());

		//今日代付总额
		$data['payout']['today']['amount'] = $this->_get_amount($merchant,'payout',$today[0],$today[1]);
		$data['payout']['today']['count'] = $this->_get_count($merchant,'payout',$today[0],$today[1]);
		
		//昨日代付总额
		$data['payout']['yesterday']['amount'] = $this->_get_amount($merchant,'payout',$yesterday[0],$yesterday[1]);
		$data['payout']['yesterday']['count'] = $this->_get_count($merchant,'payout',$yesterday[0],$yesterday[1]);
		
		//代付总额
		$data['payout']['total']['amount'] = $this->_get_amount($merchant,'payout',0,time());
		$data['payout']['total']['count'] = $this->_get_count($merchant,'payout',0,time());
		
		$dispatch = ['add'=>0,'minus'=>0,];
		$dispatch['add'] = $this->_get_dispatch($merchant,'DISPATCH_ADD',$today[0],$today[1]);
		$dispatch['minus'] = $this->_get_dispatch($merchant,'DISPATCH_MINUS',$today[0],$today[1]);
		
		$this->jout(['code'=>0,'msg'=>'OK','data'=>$data,'dispatch'=>$dispatch]);
	}
	
	//今日时间范围
	private function _get_today()
	{
		return [strtotime(date('Y-m-d').' 0:0:0'),strtotime(date('Y-m-d').' 23:59:59')];
	}
	
	//昨日时间范围
	private function _get_yesterday()
	{
		return [strtotime(date('Y-m-d',time()-86400).' 0:0:0'),strtotime(date('Y-m-d',time()-86400).' 23:59:59')];
	}
	
	//收款总额
	private function _get_amount($merchant,$bundle,$t1,$t2)
	{
		$table = 'order_'.strtolower($bundle);
		$where = 'where mid='.$merchant->getId().' and status="SUCCESS" and created_at > '.$t1 . ' and created_at < '.$t2;
		$amount = $this->entityManager->getConnection()->executeQuery('select sum(amount) as t from '.$table.' '.$where)->fetchOne();
		return null == $amount ? 0 : number_format($amount,2);
	}
	
	//数量
	private function _get_count($merchant,$bundle,$t1,$t2)
	{
		$table = 'order_'.strtolower($bundle);
		$where = 'where mid='.$merchant->getId().' and status="SUCCESS" and created_at > '.$t1 . ' and created_at < '.$t2;
		$count = $this->entityManager->getConnection()->executeQuery('select count(id) as t from '.$table.' '.$where)->fetchOne();
		return null == $count ? 0 : $count;
	}
	
	private function _get_dispatch($merchant,$bundle,$t1,$t2)
	{
		$module = 1 == $merchant->isIsTest() ? 'TEST' : 'RELEASE';
		$where = 'where merchant_id='.$merchant->getId().' and bundle="'.$bundle.'" and module = "'.$module.'" and created_at > '.$t1 . ' and created_at < '.$t2;
		$amount = $this->entityManager->getConnection()->executeQuery('select sum(amount) as t from `dispatch` '.$where)->fetchOne();
		return null == $amount ? 0 : number_format($amount,2);
	}
}
