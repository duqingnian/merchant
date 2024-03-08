<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DevelopController extends BaseController
{

    #[Route('/develop.api', name: 'develop')]
    public function index(Request $request): JsonResponse
    {
        return $this->dispatch($request);
    }
	
	public function _load_data($request)
	{
		$user = $this->user($request);
		$merchant = $this->findMerchantByUid($user->getId());
		
		echo json_encode([
			'code'=>0,
			'msg'=>'OK',
			'pay_center'=>$this->getParameter('paycenter'),
			'notify_ip'=>$this->getParameter('notify_ip'),
		]);
		exit();
	}
	
	private function GetHttpHost($host)
	{
		$hosts = explode('.',$host);
		$c = count($hosts);
		return $hosts[$c-2].'.'.$hosts[$c-1];
	}
}
