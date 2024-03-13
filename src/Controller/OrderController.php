<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class OrderController extends BaseController
{
    #[Route('/order.api', name: 'order')]
    public function index(Request $request)
    {
		$this->dispatch($request);
    }

					 
	public function _pager($request)
	{
		$user = $this->user($request);
		$merchanat = $this->findMerchantByUid($user->getId());
		
		$bundle = $request->request->get('bundle','');
		
		$filter_order_id = trim($request->request->get('filter_order_id',''));
		
		$filter_success = trim($request->request->get('filter_success','0'));
		$filter_date1 = trim($request->request->get('filter_date1',''));
		$filter_date2 = trim($request->request->get('filter_date2',''));
		$filter_ext = trim($request->request->get('filter_ext',''));
		$filter_status = trim($request->request->get('filter_status',''));
		$excel = trim($request->request->get('excel',''));
		
		$where = ' where mid='.$merchanat->getId();
		if('' != $filter_order_id)
		{
			$filter_date1 = '';
			$filter_date2 = '';
			$where .= " and (pno like '%".$filter_order_id."%' or mno like '%".$filter_order_id."%')";
		}
		if('' != $filter_ext)
		{
			$pay_process_data = $this->entityManager->getConnection()->executeQuery('select * from `pay_process_data` where mid='.$merchanat->getId().' and data like "%'.$filter_ext.'%" group by pno')->fetchAllAssociative();
			if(count($pay_process_data) > 50)
			{
				$this->e('符合条件记录>50，请优化扩展条件');
			}
			$pnos = [];
			foreach($pay_process_data as $process)
			{
				$pnos[] = $process['pno'];
			}
			if(count($pnos) > 0)
			{
				$pno_list = implode('","',$pnos);
				$where .= ' and pno in ("'.$pno_list.'")';
			}
			else
			{
				$where .= ' and pno = ""';
			}
		}

		if('' != $filter_status && 'ALL' != $filter_status)
		{
			switch($filter_status)
			{
				case 'GENERATED':
					$where .= ' and status="GENERATED"';
					break;
				case 'SUCCESS':
					$where .= ' and status="SUCCESS"';
					break;
				case 'FAIL':
					$where .= ' and status="FAIL"';
					break;
				case 'OTHER':
					$where .= ' and status!="GENERATED" and status!="SUCCESS" and status!="FAIL"';
					break;
				default:
					break;
			}
		}
		
		if('' != $filter_date1)
		{
			$start_time = strtotime($filter_date1.' 0:0:0');
			$where .= ' and created_at > '.$start_time;
		}
		if('' != $filter_date2)
		{
			$end_time = strtotime($filter_date2.' 23:59:59');
			$where .= ' and created_at < '.$end_time;
		}
		
		//查询出全部金额和手续费
		$sql = 'SELECT sum(amount) as total_amount,sum(ramount) as total_ramount,sum(cfee) as total_cfee,sum(mfee) as total_mfee  FROM `order_'.strtolower($bundle).'` '.$where;
		//echo $sql;die();
		$total = $this->entityManager->getConnection()->executeQuery($sql)->fetchAssociative();
		
		$total['total_amount'] = round($total['total_amount'],2);
		$total['total_ramount'] = round($total['total_ramount'],2);
		$total['total_cfee'] = round($total['total_cfee'],2);
		$total['total_mfee'] = round($total['total_mfee'],2);
		
		$total['total_amount'] = number_format($total['total_amount'],2,'.',',');
		$total['total_ramount'] = number_format($total['total_ramount'],2,'.',',');
		$total['total_cfee'] = number_format($total['total_cfee'],2,'.',',');
		$total['total_mfee'] = number_format($total['total_mfee'],2,'.',',');
		
		if('excel' == $excel)
		{
			//大于10万条不导出
			$total = $this->entityManager->getConnection()->executeQuery('select count(id) as t from `log` '.$where)->fetchOne();
			if(is_numeric($total) && $total > 100000)
			{
				$this->e('结果大于10万条，不导出');
			}
			
			$writer = new \App\Lib\XLSXWriter();
			if('PAYIN' == $bundle)
						 
			   
			{
				$header = array(
					'订单编号'=>'string',
					'订单金额'=>'string',
					'手续费'=>'string',
					'平台单号'=>'string',
					'商户单号'=>'string',
					'订单状态'=>'string',
					'回调'=>'string',
					'时间'=>'string',
				);
				$sql = "select id,amount,mfee,pno,mno,status,merchant_notifyed,created_at from `order_".strtolower($bundle)."` ".$where.' order by id desc';
			}
			else
			{
				$header = array(
					'订单编号'=>'string',
					'订单金额'=>'string',
					'手续费'=>'string',
					'平台单号'=>'string',
					'商户单号'=>'string',
					'持卡人姓名'=>'string',
					'卡号'=>'string',
					'订单状态'=>'string',
					'错误原因'=>'string',
					'回调'=>'string',
					'时间'=>'string',
				);
				$sql = "select id,amount,mfee,pno,mno,account_name,account_no,status,err_msg,merchant_notifyed,created_at from `order_".strtolower($bundle)."` ".$where.' order by id desc';
			}
			$writer->writeSheetHeader('Sheet1', $header);
			
			$rows = $this->entityManager->getConnection()->executeQuery($sql)->fetchAllAssociative();
			foreach($rows as $row)
			{
				$row['created_at'] = date('Y-m-d H:i:s',$row['created_at']);
				$writer->writeSheetRow('Sheet1', $row);
			}
	
			$projectRoot = $this->getParameter('kernel.project_dir').'/file_meta/'.date('Ymd');
			if(!file_exists($projectRoot))
			{
				mkdir($projectRoot);
			}
			$excel_file_name = strtoupper(md5($merchanat->getId().microtime())).'.xls';
			$excel_file = $projectRoot.'/'.$excel_file_name;
			$writer->writeToFile($excel_file);

			//开始写入数据库
			$file_meta = new \App\Entity\FileMeta();
			$file_meta->setFilename('/file_meta/'.date('Ymd').'/'.$excel_file_name);
			$file_meta->setExt('xls');
			$file_meta->setMid($merchanat->getId());
			$file_meta->setCreatedAt(time());
			$file_meta->setDisplayName('订单-'.$merchanat->getName().'-'.date('Y年m月d日H时i分秒'));
			$file_meta->setSummary($total.'条记录');
			$this->save($file_meta);

			$token = $this->authcode('FILEID:'.$merchanat->getUid().':'.$file_meta->getId());
			$url = $this->generateUrl('file_download',['token'=>$token],UrlGeneratorInterface::ABSOLUTE_URL);
			$url = str_replace('http:','https:',$url);

			echo json_encode(['code'=>0,'msg'=>'OK','url'=>$url]);
			die();
		}
		

        $orders = $this->pager($request,'*','order_'.strtolower($bundle),$where);
		foreach($orders['rows'] as &$row)
		{
			$row['request_token'] = $this->authcode('ID:'.$row['id']);
			$channel = $this->findOneById('channel',$row['cid']);

			//查询商户
			$merchant = $this->findOneById('merchant',$row['mid']);
			$row['merchant'] = '-';
			if($merchant)
			{
				$row['merchant'] = '['.$merchant['id'].']'.$merchant['name'];
			}
			
			//商户回调
			$row['merchant_notify'] = ['http_code'=>-1,'ret'=>''];
			$merchant_notify = $this->entityManager->getConnection()->executeQuery('select * from `merchant_notify_log` where order_id='.$row['id'].' and bundle="'.$bundle.'"  order by id desc')->fetchAssociative();
			if($merchant_notify)
			{
				$row['merchant_notify'] = ['http_code'=>$merchant_notify['ret_http_code'],'ret'=>strtolower(mb_substr($merchant_notify['ret'],0,10))];
			}
			
			//查询商户发来的数据
			$request_data_object = $this->db(\App\Entity\PayProcessData::class)->findOneBy(['bundle'=>'M_RTPF_D','pno'=>$row['pno']]);
			
			//查询通道需要显示的扩展字段
			$row['channel_show_columns'] = [];
			if($request_data_object)
			{
				$request_data = json_decode($request_data_object->getData(),true);
				$columns = $this->entityManager->getConnection()->executeQuery('select * from channel_column_map where bundle="'.strtoupper($bundle).'" and is_show=1 and cid='.$channel['id'])->fetchAllAssociative();
				foreach($columns as $column)
				{
					if(array_key_exists($column['pcolumn'], $request_data))
					{
						$row['channel_show_columns'][] = ['pcolumn'=>$column['pcolumn'],'text'=>$column['name'],'value'=>$request_data[$column['pcolumn']]];
					}
				}
			}
			
			$row['err_code'] = '创建失败';
			$row['err_msg'] = 'test err reason';
			
			$row['created_at'] = date('Y-m-d H:i:s',$row['created_at']);
		}

		$this->console(['orders'=>$orders, 'total'=>$total]);
	}
	
	
	//详情
	public function _detail($request)
	{
		$bundle = $request->request->get('bundle','');
		$order_id = $this->GetId($request->request->get('request_token',''));
		$order = $this->findOneById('order_'.strtolower($bundle),$order_id);
		if(!$order)
		{
			$this->e('不存在');
		}
		
		/*
		$bundle_map = [
			'M_RTPF_D'=>'1. 商户发起数据',
			'PF_RTC_D'=>'2. 平台发给通道数据',
			'C_RTPF_D'=>'3. 通道同步返回数据',
			'C_RTPF_CD'=>'4. 通道同步返回数据 - 清洗后',
			'PF_RTM_D'=>'5. 平台同步返回给商户数据',
			'C_NTPF_D'=>'6. 通道回调给平台数据',
			'C_NTPF_CD'=>'7. 通道回调给平台数据 - 清洗后',
		];
		*/
		
		$bundle_map = [
			'M_RTPF_D'=>'1. 商户发起数据',
			'PF_RTM_D'=>'2. 平台同步返回数据',
		];
		
		//判断是不是手工单 手工单不显示流程数据和回调数据
		$order['is_handle'] = 0;
		if('MH' == substr($order['mno'],0,2))
		{
			$order['is_handle'] = 1;
																 
		}
		
		//流程数据
		$order['process_list'] = [];
		$order['merchant_notify_data'] = [];
		if(1 == $order['is_handle'])
		{
			$order['process_list'] = $this->entityManager->getConnection()->executeQuery('SELECT * FROM `pay_process_data` where (bundle="M_RTPF_D" or bundle="PF_RTM_D") and pno = "'.$order['pno'].'"')->fetchAllAssociative();
			foreach($order['process_list'] as &$process)
			{
				$process['title'] = $bundle_map[$process['bundle']];
				$process['time'] = date('Y-m-d H:i:s',$process['created_at']);
			}
			
			//回调给商户的数据
			$order['merchant_notify_data'] = $this->entityManager->getConnection()->executeQuery('SELECT * FROM `merchant_notify_log` where order_id ='.$order['id'])->fetchAllAssociative();
			foreach($order['merchant_notify_data'] as &$notify_data)
			{
				$notify_data['target_time'] = date('Y-m-d H:i:s',$notify_data['target_time']);
				$notify_data['created_at'] = date('Y-m-d H:i:s',$notify_data['created_at']);
				
				if(false !== strstr($notify_data['merchant_notify_url'],'baishipay'))
				{
					$notify_data['merchant_notify_url'] = '手工单';
				}
			}
		}
		
		//如果订单状态为FAIL，需要查询错误原因
		$order['err_code'] = '创建失败';
		$order['err_msg'] = 'test err reason';
		
		$order['request_token'] = $this->authcode('ID:'.$order['id']);
		$this->console($order);
	}

	//发送回调  手工重发、模拟成功、模拟失败
	public function _send_notify($request)
	{
		$exchange = $request->request->get('exchange','');
		$bundle = $request->request->get('bundle','');
		$order_id = $this->GetId($request->request->get('request_token',''));
		$order = $this->findOneById('order_'.strtolower($bundle),$order_id);
		if(!$order)
		{
			$this->e('订单不存在:'.$order_id);
		}
		
		$merchant = $this->findOneById('merchant',$order['mid']);
		if(!$merchant)
		{
			$this->e('商户不存在');
		}

		$merchant_notify_log = $this->findOneById('merchant_notify_log',$order['id'],'order_id');
		if(!$merchant_notify_log)
		{
			$this->e('未找到回调数据，无法发送:'.$order_id);
		}
			
		//如果是重新发送
		if('HAND_RESEND' == $exchange)
		{
			$notify_data = $merchant_notify_log['data'];
		}
		else if('MONI_SUCC' == $exchange || 'MONI_FAIL' == $exchange)
		{
			$__status = '';
			
			if('MONI_SUCC' == $exchange){$__status = 'SUCCESS';}
			if('MONI_FAIL' == $exchange){$__status = 'FAIL';}
			
			$_secret = '';
			if('PAYIN' == strtoupper($bundle)){$_secret = $merchant['payin_secret'];}
			if('PAYOUT' == strtoupper($bundle)){$_secret = $merchant['payout_secret'];}
			
			$data = [
				'amount'=>$order['amount'],
				'fee'=>$order['mfee'],
				'order_status'=>$__status,
				'plantform_order_no'=>$order['pno'],
				'shanghu_order_no'=>$order['mno'],
				'time'=>time(),
			];
				
			$str = $this->stand_ascii_params($data);
			$str = $str.'&key='.$_secret;
			$sign = md5($str);

			$data['sign'] = $sign;
			$notify_data = json_encode($data);
		}
		else
		{
			$this->e('未知操作:'.$exchange);
		}
		
		$ret = $this->post_json($merchant_notify_log['merchant_notify_url'],$notify_data);
		if(strlen($ret['1']) > 1000)
		{
			$ret['1'] = substr($ret['1'],0,1000);
		}
		echo json_encode([
			'code'=>0,
			'msg'=>'OK',
			'merchant_notify_result'=>[
				'is_open'=>true,
				'merchant'=>$merchant,
				'order'=>$order,
				'result'=>[
					'http_code'=>$ret[0],
					'ret'=>$ret[1],
					'merchant_notify_url'=>$merchant_notify_log['merchant_notify_url']
				],
				'time'=>date('Y-m-d H:i:s',time()),
			],
		]);
		die();
	}
	
}
