<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UtilController extends BaseController
{
	#[Route('/util.api', name: 'util')]
    public function index(Request $request)
    {
		$this->dispatch($request);
    }
	
	#[Route('/util.qrcode', name: 'util_qrcode')]
    public function qrcode(Request $request)
    {
		$token = $request->query->get('token','');
		if('' == $token)
		{
			$this->e('token is missing');
		}
		
		$token = $this->authcode($token, 'DECODE');
		if('BUNDLE:' != substr($token,0,7))
		{
			$this->e('token is error:'.substr($token,0,20));
		}
		//BUNDLE:GOOGLE:UID:'.$user->getId().':'.$title
		//'BUNDLE:GOOGLE:MID:'.$user->getId().':'.$vip_title
		$tokens = explode(':',$token);
		$bundle = $tokens[0];
		
		$google_authenticator = new \App\Utils\GoogleAuthenticator();
		if('GOOGLE' == $tokens[1])
		{
			$id = $tokens[2];
			$title = $tokens[4];
			if('UID' == $id)
			{
				$uid = $tokens[3];
				
				$user = $this->entityManager->getRepository(\App\Entity\User::class)->find($uid);
				if(!$user)
				{
					$this->e('账号不存在');
				}
				$secret = $user->getGoogleSecret();
			}
			else if('MID' == $id)
			{
				$uid = $tokens[3];
				
				$merchant = $this->findMerchantByUid($uid);
				if(!$merchant)
				{
					$this->e('merchant not exist');
				}
				$secret = $merchant->getVipGoogleSecret();
			}
			else
			{}
		
			$qrcode_string = $google_authenticator->GetQRcodeData($title,$secret);
			$qrcode_string = urldecode($qrcode_string);
		}
		else if('PAYIN_ORDER_QRCODE' == $tokens[1])
		{
			$qrcode_string = urldecode($tokens[3]);
		}
		else
		{
			$this->e('bundle err:'.$bundle);
		}
		
		
		
		$projectRoot = $this->getParameter('kernel.project_dir');
		include $projectRoot.'/lib/phpqrcode/qrlib.php';
		$svg = \QRcode::svg($qrcode_string);
		echo $svg;
		exit();
    }

}
	