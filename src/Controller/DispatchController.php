<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DispatchController extends BaseController
{
    #[Route('/dispatch.api', name: 'dispatch')]
    public function index(Request $request)
    {
		$this->dispatch($request);
    }
	
	//载入通道数据
	public function _pager($request)
	{
		$user = $this->user($request);
		$merchanat = $this->findMerchantByUid($user->getId());
		$bundle = $request->request->get('bundle','');
		$show_filter = $request->request->get('show_filter','');
		
		$bundle_map = ['DISPATCH_ADD'=>'充值','DISPATCH_MINUS'=>'减下发'];
		
		$where = ' where merchant_id='.$merchanat->getId();
		
		if('' == $show_filter)
		{
			$where .= ' and id < 0';
		}
		else
		{
			$show_bundles = explode(',',$show_filter);
			foreach($show_bundles as $show_bundle)
			{
				if(!in_array($show_bundle, array_keys($bundle_map)))
				{
					$this->e('过滤条件不合法');
				}
			}
			$show_bundles = implode('","',$show_bundles);
			$where .= ' and bundle in ("'.$show_bundles.'")';
		}
		
        $logs = $this->pager($request,'*','dispatch',$where);
		
		$success_bundle = ['DISPATCH_ADD'];
		$danger_bundle = ['DISPATCH_MINUS'];
		
		foreach($logs['rows'] as &$row)
		{
			$bundle = $row['bundle'];
			
			$row['type'] = $bundle_map[$bundle];
			$row['created_at'] = date('Y-m-d H:i:s',$row['created_at']);
			
			$row['money_before'] = $row['snapshot'];
			$row['money'] = $row['amount'];
			$row['money_after'] = $row['dispatched'];
			
			$row['intent'] = '';
			if(in_array($bundle,$success_bundle))
			{
				$row['intent'] = 'Success';
			}
			if(in_array($bundle,$danger_bundle))
			{
				$row['intent'] = 'Danger';
			}
		}
        
		$this->console(['logs'=>$logs]);
	}
}
