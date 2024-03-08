<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LogController extends BaseController
{
    #[Route('/log.api', name: 'log')]
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
		
		$bundle_map = ['ADD_BALANCE'=>'增加余额','SUB_BALANCE'=>'减少余额','ADD_DF'=>'增加代付','SUB_DF'=>'减少代付'];
		$summary_map = ['PI_SUCC'=>'代收成功','PO_CREATED'=>'创建代付','PO_FAIL_NOTIFY'=>'代付失败'];
		
		$where = ' where mid='.$merchanat->getId();
		
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
		
        $logs = $this->pager($request,'*','log',$where);
		
		$success_bundle = ['DISPATCH_ADD','ADD_BALANCE','ADD_DF'];
		$danger_bundle = ['DISPATCH_MINUS','SUB_BALANCE','SUB_DF'];
		
		foreach($logs['rows'] as &$row)
		{
			$data = $row['data'];
			$bundle = $row['bundle'];
			
			unset($row['data']);
			if('' != $row['summary'])
			{
				if('' != $data)
				{
					$data_arr = json_decode($data,true);
					
					if(is_array($data_arr) && array_key_exists('mfee',$data_arr))
					{
						if(!in_array($row['bundle'],['ADD_DF','SUB_DF']))
						{
							if('PO' == substr($row['summary'],0,2))
							{
								$row['money'] += $data_arr['mfee'];
							}
							else
							{
								$row['money'] -= $data_arr['mfee'];
							}
						}
					}
				}
			}
			
			$row['type'] = $bundle_map[$bundle];
			$row['note'] = '';
			if('' != $row['summary'] && array_key_exists($row['summary'], $summary_map))
			{
				$row['note'] = $summary_map[$row['summary']];
			}
			$row['created_at'] = date('Y-m-d H:i:s',$row['created_at']);
			
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
	
	//登录日志
	public function _login($request)
	{
		$user = $this->user($request);
		$merchanat = $this->findMerchantByUid($user->getId());
		$bundle = $request->request->get('bundle','');
		$show_filter = $request->request->get('show_filter','');
		
		$where = ' where mid='.$merchanat->getId().' and result="OK"';
		
        $logs = $this->pager($request,'*','login_log',$where);
		
		foreach($logs['rows'] as &$row)
		{
			$agent = $row['agent'];
			unset($row['agent']);
			unset($row['try_password']);
			
			$agent = json_decode($agent, true);
			$row['browser'] = $agent['agent'][0];
			$row['google'] = $row['with_google'] == '' ? '-' : '√';
			
			$row['created_at'] = date('Y-m-d H:i:s',$row['created_at']);
		}
        
		$this->console(['logs'=>$logs]);
	}
	
}
