<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends BaseController
{
	public function start(Request $request, AuthenticationException $authException = null): RedirectResponse
    {
        $request->getSession()->getFlashBag()->add('note', 'You have to login in order to access this page.');
        return new RedirectResponse($this->urlGenerator->generate('security_login'));
    }
	
	#[Route('/', name: 'app_default')]
    public function index(){return $this->_render();}
	
	#[Route('/google', name: 'app_google')]
    public function google(){return $this->_render();}
	
	#[Route('/order_payin', name: 'order_payin')]
    public function order_payin(){return $this->_render();}
	
	#[Route('/order_payout', name: 'order_payout')]
    public function order_payout(){return $this->_render();}
	
	#[Route('/hand_payin', name: 'hand_payin')]
    public function hand_payin(){return $this->_render();}
	
	#[Route('/hand_payout', name: 'hand_payout')]
    public function hand_payout(){return $this->_render();}
	
	#[Route('/develop_api', name: 'develop_api')]
    public function develop_api(){return $this->_render();}
	
	#[Route('/multi_payout', name: 'multi_payout')]
    public function multi_payout(){return $this->_render();}
	
	#[Route('/document', name: 'document')]
    public function document(){return $this->_render();} 
	
	#[Route('/log_index', name: 'log_index')]
    public function log_index(){return $this->_render();} 
	
	#[Route('/log_login', name: 'log_login')]
    public function log_login(){return $this->_render();} 
	
	#[Route('/log_tixian', name: 'log_tixian')]
    public function log_tixian(){return $this->_render();}
	
    private function _render()
	{
		$merchant = $this->findMerchantByUid($this->getUser()->getId());
		$merchant_is_test = $this->GetBool($merchant->isIsTest());
		$merchant_is_active = $this->GetBool($merchant->isIsActive());
		return $this->render("default.html.twig",[
			'SchemeAndHttpHost'=>'https://'.$_SERVER['HTTP_HOST'],
			'UserAccessToken'=>$this->authcode('ID:'.$this->getUser()->getId()),
			'Merchant'=>$merchant,
			'merchant_is_test'=>$merchant_is_test,
			'merchant_is_active'=>$merchant_is_active,
		]);
	}
	
	#[Route('/debug', name: 'debug')]
    public function debug(Request $request)
	{
		/*
		//拉取代收通道
		$api = 'https://payment.wolong.in/channel';
		$data = [
			'action'=>'fetch',
			'appid'=>'ADC39055BB1172',
			'bundle'=>'PAYIN',
			'time'=>time(),
		];
		$data['sign'] = $this->_hash_hmac($data,'SN2503G9HYM09WGS1XJ4HDK4JXN0');
		$ret = $this->post_form($api,$data);
		print_r($ret);die();
		*/
		
		//拉取代收通道
		/*
		$api = 'https://payment.wolong.in/channel';
		$data = [
			'action'=>'fetch',
			'appid'=>'ADB11F729758819260',
			'bundle'=>'PAYOUT',
			'time'=>time(),
		];
		$data['sign'] = $this->_hash_hmac($data,'SN0YX7KY16JZDCNAQJGSYF7ZATZH');
		$ret = $this->post_form($api,$data);
		print_r($ret);die();
		*/
	}
}
