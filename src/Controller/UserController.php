<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UserController extends BaseController
{
	protected UserPasswordHasherInterface $passwordHasher;
	
	public function __construct(
		UserPasswordHasherInterface $_passwordHasher,
		EntityManagerInterface $_entityManager,
	)
	{
		$this->passwordHasher = $_passwordHasher;
		$this->entityManager = $_entityManager;
	}

    #[Route('/user.api', name: 'user')]
    public function index(Request $request): JsonResponse
    {
        return $this->dispatch($request);
    }
	
	public function _fetch_user($request): JsonResponse
	{
		$user = $this->user($request);
		$merchant = $this->findMerchantByUid($user->getId());

		$user = [
			'is_active'=>(int)$merchant->isIsActive(),
			'is_test'=>(int)$merchant->isIsTest(),
			'amount'=>$merchant->isIsTest() ? number_format($merchant->getTestAmount(),2) : number_format($merchant->getAmount(),2),
			'test_amount'=>number_format($merchant->getTestAmount(),2),
			'freeze'=>number_format($merchant->getFreezePool(),2),
			'df_pool'=>$merchant->isIsTest() ? number_format($merchant->getTestDfPool(),2) : number_format($merchant->getDfPool(),2),
		];
		
		$this->jout(['code'=>0,'msg'=>'OK','user'=>$user]);
	}
	
	public function _password($request)
	{
		$user = $this->user($request);
        
        $password = $request->request->get('password','');
		if('' == $password)
		{
			$this->e('没有提交任何数据');
		}
        $password = json_decode($password,true);
		if(!is_array($password) || 3 != count($password))
		{
			$this->e('提交的数据格式不对');
		}
        
        $password1 = $password['password1'];
        $password2 = $password['password2'];
        $password3 = $password['password3'];
		
		if(strlen($password2) < 6)
		{
			$this->e('新密码不能小于6位数');
		}
		if(strlen($password2) > 16)
		{
			$this->e('新密码不能大于16位数');
		}

		if('' == $password1 || '' == $password2 || '' == $password3)
		{
			$this->e('密码不能为空');
		}

        if($password2!=$password3){
            $this->e('两次密码不一样');
        }
        if($password1==$password3){
            $this->e('新密码不能和旧密码相同');
        }
        
		if($this->passwordHasher->isPasswordValid($user,$password1))
		{
			$user->setPassword($this->passwordHasher->hashPassword($user,$password2));
			$this->update();
			$this->succ('更新成功');
		}
		else
		{
			$this->e('原密码不正确：'.$user->getUsername().':'.$user->getId());
		}
        exit();
	}

	public function _google($request)
	{
		$uid = $this->GetId($request->request->get('_access_token',''));
		$user = $this->entityManager->getRepository(\App\Entity\User::class)->find($uid);
		if(!$user)
		{
			$this->e('账号不存在');
		}
		
		$merchant = $this->findMerchantByUid($user->getId());
		
		$binded = (int)$user->isGoogleBinded();
        $qrcode = '';
        
        $vip_binded = (int)$merchant->isVipGoogleBinded();
        $vip_qrcode = '';
		
		$google_authenticator = new \App\Utils\GoogleAuthenticator();
		if('' == $user->getGoogleSecret())
		{
			$user->setGoogleSecret($google_authenticator->createSecret(32));
			$this->update();
		}
		if('' == $merchant->getVipGoogleSecret())
		{
			$merchant->setVipGoogleSecret($google_authenticator->createSecret(32));
			$this->update();
		}
		
		$title = $this->GetHttpHost($_SERVER['HTTP_HOST']).' - '.$user->getId();
		if(0 == $binded)
		{
			$qrcode = $this->generateUrl('util_qrcode',['token'=>$this->authcode('BUNDLE:GOOGLE:UID:'.$user->getId().':'.$title)], UrlGeneratorInterface::ABSOLUTE_URL);
		}

		$vip_title = $this->GetHttpHost($_SERVER['HTTP_HOST']).' - !!! - '.$user->getId();
		if(0 == $vip_binded)
		{
			$vip_qrcode = $this->generateUrl('util_qrcode',['token'=>$this->authcode('BUNDLE:GOOGLE:MID:'.$user->getId().':'.$vip_title)], UrlGeneratorInterface::ABSOLUTE_URL);
		}
		
		$data = [
			'code'=>0,
			'msg'=>'OK',
			'binded'=>$binded,
			'qrcode'=>$qrcode,
			'vip_binded'=>$vip_binded,
			'vip_qrcode'=>$vip_qrcode,
			'title'=>$title,
			'vip_title'=>$vip_title,
			'google_secret'=>'',
			'vip_google_secret'=>'',
		];
		
		if(0 == $binded)
		{
			$data['google_secret'] = $user->getGoogleSecret();
		}
		if(0 == $vip_binded)
		{
			$data['vip_google_secret'] = $merchant->getVipGoogleSecret();
		}

		echo json_encode($data);
		die();
	}
	
	public function _bind_google($request)
	{
		$identity = strtoupper($request->request->get('identity','')); //LOGIN IMPORTANT
		$bundle = $request->request->get('bundle','');
		if(!in_array($bundle,['BIND','UNBIND']))
		{
			$this->e('操作错误:'.$bundle);
		}
		$code = $request->request->get('code','');
		if(6 != strlen($code))
		{
			$this->e('谷歌验证码必须六位数:'.$code);
		}
		
		$uid = $this->GetId($request->request->get('_access_token',''));
		$user = $this->entityManager->getRepository(\App\Entity\User::class)->find($uid);
		if(!$user)
		{
			$this->e('账号不存在');
		}
		$merchant = $this->findMerchantByUid($user->getId());
		$google_authenticator = new \App\Utils\GoogleAuthenticator();
		if('BIND' == $bundle)
		{
			if('LOGIN' == $identity)
			{
				$bind = (int)$user->isGoogleBinded();
				$google_secret = $user->getGoogleSecret();
			}
			if('IMPORTANT' == $identity)
			{
				$bind = (int)$merchant->isVipGoogleBinded();
				$google_secret = $merchant->getVipGoogleSecret();
			}
			if(1 == $bind)
			{
				$this->e('请勿重复绑定,如需解绑或者换绑请联系客服或者运维');
			}
			if('' == $google_secret)
			{
				$this->e($user->getId().':'.$identity.'谷歌密钥为空，请刷新页面后重试');
			}
			
			$checkResult = $google_authenticator->verifyCode($google_secret, $code, 2);
			if (!$checkResult)
			{
				$this->e('谷歌验证码错误');
			}
			
			if('LOGIN' == $identity)
			{
				$user->setGoogleBinded(1);
			}
			if('IMPORTANT' == $identity)
			{
				$merchant->setVipGoogleBinded(1);
			}
			$this->update();

			echo json_encode(['code'=>0,'msg'=>'已绑定谷歌','binded'=>1]);
			die();
		}
		else if('UNBIND' == $bundle)
		{
			if('LOGIN' == $identity)
			{
				$bind = (int)$user->isGoogleBinded();
				$google_secret = $user->getGoogleSecret();
			}
			if('IMPORTANT' == $identity)
			{
				$bind = (int)$merchant->isVipGoogleBinded();
				$google_secret = $merchant->getVipGoogleSecret();
			}
			if(0 == $bind)
			{
				$this->e('当前未绑定');
			}
			if('' == $google_secret)
			{
				$this->e('谷歌密钥为空，请刷新页面后重试');
			}
			
			$checkResult = $google_authenticator->verifyCode($google_secret, $code, 2);
			if (!$checkResult)
			{
				$this->e('谷歌验证码错误');
			}
			
			if('LOGIN' == $identity)
			{
				$user->setGoogleSecret('');
				$user->setGoogleBinded(0);
			}
			if('IMPORTANT' == $identity)
			{
				$merchant->setVipGoogleBinded(0);
				$merchant->setVipGoogleSecret('');
			}
			$this->update();

			echo json_encode(['code'=>0,'msg'=>'已解绑谷歌','binded'=>0]);
			die();
		}
		else
		{
			$this->e('bundle非法:'.$bundle);
		}
		$this->e('操作异常:'.$bundle);
	}
	
	private function GetHttpHost($host)
	{
		$hosts = explode('.',$host);
		$c = count($hosts);
		return $hosts[$c-2].'.'.$hosts[$c-1];
	}
	
	public function _load_api($request)
	{
		$uid = $this->GetId($request->request->get('_access_token',''));
		$user = $this->entityManager->getRepository(\App\Entity\User::class)->find($uid);
		if(!$user)
		{
			$this->e('账号不存在');
		}
		
		$merchant = $this->findMerchantByUid($user->getId());
		
		$data = [
			'code'=>0,
			'msg'=>'OK',
			'data'=>[
				'is_active'=>$merchant->isIsActive(),
				'is_test'=>$merchant->isIsTest(),
				'payin_appid'=>$merchant->getPayinAppid(),
				'payin_secret'=>$merchant->getPayinSecret(),
				'payout_appid'=>$merchant->getPayoutAppid(),
				'payout_secret'=>$merchant->getPayoutSecret(),
			]
		];
		
		echo json_encode($data);exit();
	}
	
	
}
