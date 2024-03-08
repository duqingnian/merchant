<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PayinController extends BaseController
{

    #[Route('/payin.api', name: 'payin')]
    public function index(Request $request): JsonResponse
    {
        return $this->dispatch($request);
    }
	
	public function _create($request): JsonResponse
	{
		$amount = $request->request->get('amount',0);
		if(is_numeric($amount) && $amount > 0)
		{
			//
		}
		else
		{
			$this->e('金额必须大于0的数字');
		}
		
		$user = $this->user($request);
		$merchant = $this->findMerchantByUid($user->getId());
		
		$payin_appid  = $merchant->getPayinAppid();
		$payin_secret = $merchant->getPayinSecret();
		if('' == $payin_appid){$this->e('代收appid为空，无法创建');}
		if('' == $payin_secret){$this->e('代收密钥为空，无法创建');}
		
		$order_no = 'MH'.md5(time().$payin_appid.$payin_secret);
		
		$notify_url = $this->generateUrl('api_notify',['order_no'=>$order_no],UrlGeneratorInterface::ABSOLUTE_URL);
		$notify_url = str_replace('http:','https:',$notify_url);
		
		if(1 == $merchant->isIsTest())
		{
			$order_no = 'T'.$order_no;
		}
		
		$timestamp = time();
		
		$post_parameters = [
			'appid'=>$payin_appid,
			'amount'=>$amount,
			'order_no'=>$order_no,
			'notify_url'=>$notify_url,
			'timestamp'=>$timestamp,
			'version'=>'2.0'
		];
		
		$sign_data = [
			'appid'=>$payin_appid,
			'order_no'=>$order_no,
			'amount'=>$amount,
			'timestamp'=>$timestamp,
			'version'=>'2.0'
		];
		
		$post_parameters['sign'] = $this->_hash_hmac($sign_data,$payin_secret);
		//提交给API
		$ret = $this->post_form($this->getParameter('paycenter').'/api/payment/order/create',$post_parameters);
		 
		if(!array($ret))
		{
			$this->e('http error! ret not an array! errCode:60159');
		}
		if(200 != $ret[0])
		{
			$this->e('pay api return not 200,content:'.$ret[1]);
		}
		$ret = $ret[1];
		if('' == $ret)
		{
			$this->e('An error occurred, empty payment result!');
		}
		
		$data = json_decode($ret,true);
		if(!is_array($data))
		{
			echo json_encode(['code'=>-1,'msg'=>'API_RETURN_INVALIDATE_JSON','ret'=>$ret]);
			die();
		}
		if(count($data) < 2 || !array_key_exists('code',$data))
		{
			echo json_encode(['code'=>-1,'msg'=>'An error occurred, invalidate result dataArray!','ret'=>$ret]);
			die();
		}
		
		if(0 != $data['code'])
		{
			$err = ['code'=>$data['code'],'msg'=>$data['msg']];
			if(array_key_exists('post_data',$data)) $err['post_data'] = $data['post_data'];
			if(array_key_exists('api_result',$data)) $err['api_result'] = $data['api_result'];
			echo json_encode($err);
			die();
		}
		
		if(!array_key_exists('shanghu_order_no',$data))
		{
			echo json_encode(['code'=>-1,'msg'=>'An error occurred, shanghu_order_no not in dataArray!','ret'=>$ret]);
			die();
		}

		$pay_url = '';
		if(array_key_exists('pay_url',$data) && '' != $data['pay_url'])
		{
			$pay_url = trim($data['pay_url']);
		}
		else
		{
			$this->e('无法生成支付地址');
		}
		
		$data['qrcode_img_src'] = '';
		if('' != $pay_url)
		{
			$data['qrcode_img_src'] = $this->generateUrl('util_qrcode',['token'=>$this->authcode('BUNDLE:PAYIN_ORDER_QRCODE:URL:'.urlencode($pay_url))], UrlGeneratorInterface::ABSOLUTE_URL);
		}
		$data['jump_url'] = $pay_url;
		echo json_encode($data);
		exit();
	}
	
	function _ascii_params($params = array())
	{
		if (!empty($params)) 
		{
			$p = ksort($params);
			if ($p) 
			{
				$str = '';
				foreach ($params as $k => $val) 
				{
					$str .= $k . '=' . $val . '&';
				}
				$strs = rtrim($str, '&');
				return $strs;
			}
		}
		return '';
	}
	
	function _hash_hmac($data, $key)
	{
		$str = $this->_ascii_params($data);
		$signature = "";
		if (function_exists('hash_hmac')) 
		{
			$signature = base64_encode(hash_hmac("sha1", $str, $key, true));
		}
		else
		{
			$blocksize = 64;
			$hashfunc = 'sha1';
			if (strlen($key) > $blocksize) 
			{
				$key = pack('H*', $hashfunc($key));
			}
			$key = str_pad($key, $blocksize, chr(0x00));
			$ipad = str_repeat(chr(0x36), $blocksize);
			$opad = str_repeat(chr(0x5c), $blocksize);
			$hmac = pack('H*', $hashfunc(($key ^ $opad) . pack('H*', $hashfunc(($key ^ $ipad) . $str))));
			$signature = base64_encode($hmac);
		}
		return $signature;
	}
}


