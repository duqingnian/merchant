<?php
namespace App\Utils;

use Doctrine\ORM\EntityManagerInterface;

class UtilPayout
{
	//批量代付
	public function dispatch(EntityManagerInterface $entityManager, $D)
    {
		$D = json_decode($D,true);
		$paycenter = $D['paycenter'];
		$mpo_id = $D['mpo_id'];
		$multi_payout_order = $entityManager->getRepository(\App\Entity\MultiPayoutOrders::class)->find($mpo_id);
		if($multi_payout_order)
		{
			$mpo_data = json_decode($multi_payout_order->getData(), true);
			if(1)
			{
				$ret = $this->post_json($paycenter,$mpo_data);
				$errMsg = "";
				
				if('' == $errMsg && '' == $ret)
				{
					$errMsg = 'HTTP_REQUEST_NULL';
				}
				
				if('' == $errMsg && !array($ret))
				{
					$errMsg = 'http error! ret not an array:'.substr($ret,0,200);
				}
				if('' == $errMsg && 200 != $ret[0])
				{
					$errMsg = 'pay api return not 200ok,content:'.substr($ret[1],0,200);
				}
				$data = $ret[1];
				if('' == $errMsg && '' == $data)
				{
					$errMsg = 'API_RETURN_NULL';
				}
				$data = json_decode($data,true);

				if('' == $errMsg && (count($data) < 2 || !array_key_exists('code',$data)))
				{
					$errMsg = 'NOT_CONTAINS_CODE:'.substr($ret[1],0,200);
				}
				
				if('' == $errMsg && 0 != $data['code'])
				{
					$errMsg = 'CODE_NOT_0:'.substr($ret[1],0,200);
				}
				
				//创建成功
				if('' == $errMsg)
				{
					$multi_payout_order->setPno($data['plantform_order_no']);
					$multi_payout_order->setErrCode(0);
				}
				else
				{
					$multi_payout_order->setErrCode($data['code']);
				}
				$multi_payout_order->setErrMsg($errMsg);
				
				//更新批量记录
				$multi_payout = $entityManager->getRepository(\App\Entity\MultiPayout::class)->find($multi_payout_order->getPid());
				$multi_payout->setGeneratedCount($multi_payout->getGeneratedCount() + 1);
				$multi_payout->setStatus('ING');
				$multi_payout->setCompleteAt($multi_payout->getGeneratedCount() + 1 == $multi_payout->getTotalCount() ? time() : 0);
				$multi_payout->setUpdatedAt(time());
				$multi_payout->setGeneratedAmount($multi_payout->getGeneratedAmount() + $mpo_data['amount']);
				if('' == $errMsg)
				{
					$multi_payout->setSuccCount($multi_payout->getSuccCount() + 1);
					$multi_payout->setSuccAmount($multi_payout->getSuccAmount() + $mpo_data['amount']);
				}
				$entityManager->flush();
				
				if($multi_payout->getGeneratedCount() == $multi_payout->getTotalCount())
				{
					$multi_payout->setStatus('DONE');
					$entityManager->flush();
				}
				
				echo 'complete';
			}
		}
	}
	function post_json($url, $jsonStr,$header=[],$method='POST')
	{
		if(is_array($jsonStr))
		{
			$jsonStr = json_encode($jsonStr);
		}
		$ch = curl_init();
		if('GET' == $method)
		{
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		}
		else
		{
			curl_setopt($ch, CURLOPT_POST, 1);
		}
		$header[] = 'Content-Type: application/json;charset=utf-8';
		$header[] = 'Content-Length: ' . strlen($jsonStr);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		return array($httpCode, $response);
	}
	private function post_form($url, $data = null,$header=[],$method='POST') {
        $curl = curl_init ();
        curl_setopt ( $curl, CURLOPT_URL, $url );
        curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, FALSE );
        if (! empty ( $data )) 
		{
            curl_setopt ( $curl, CURLOPT_POST, 1 );
			$header[] = 'Content-Type: application/x-www-form-urlencoded;charset=utf-8';
			curl_setopt ( $curl, CURLOPT_POSTFIELDS, http_build_query($data) );
        }
        curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
        $response = curl_exec($curl);
		$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		return array($httpCode, $response);
    }
}
