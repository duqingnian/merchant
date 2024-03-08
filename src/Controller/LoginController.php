<?php
//src/Controller/LoginController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;

class LoginController extends AbstractController
{
	private UserPasswordHasherInterface $passwordHasher;
	private EntityManagerInterface $entityManager;
	private TokenStorageInterface $tokenStorage;
	private EventDispatcherInterface $eventDispatcher;

	public function __construct(
		UserPasswordHasherInterface $_passwordHasher,
		EntityManagerInterface $_entityManager,
		TokenStorageInterface $_tokenStorage, 
		EventDispatcherInterface $_eventDispatcher
	)
	{
		$this->passwordHasher = $_passwordHasher;
		$this->entityManager = $_entityManager;
		$this->tokenStorage = $_tokenStorage;
		$this->eventDispatcher = $_eventDispatcher;
	}
	
    #[Route('/login', name: 'app_login' , methods: ['GET','POST'])]
    public function index(Request $request,Security $security)
    {
		
		return $this->render('login/index.html.twig');
    }
	
	#[Route('/login.api', name: 'app_login_api' , methods: ['POST'])]
    public function api(Request $request,Security $security)
    {
		if($request->isMethod('POST'))
		{
			$headers = $request->headers->all();
			$referer = $headers['referer'];
			$userAgent = $headers['user-agent'];

			$username = $request->request->get('username','');
			$password = $request->request->get('password','');
			$google_code = $request->request->get('google_code','');
			$csrf_token = $request->request->get('_csrf_token','');
			
			$login_log = new \App\Entity\LoginLog();
			$login_log->setAccount(substr($username,0,32));
			$login_log->setTryPassword(substr($password,0,4)."***");
			$login_log->setIp($this->GetIp());
			$login_log->setAgent(json_encode(['agent'=>$userAgent,'referer'=>$referer]));
			$login_log->setCreatedAt(time());
			$login_log->setResult('');
			$login_log->setWithGoogle(substr($google_code,0,6));
			$login_log->setUid(0);
			$login_log->setMid(0);
			$this->entityManager->persist($login_log);
			$this->entityManager->flush();
			
			if (!$this->isCsrfTokenValid('authenticate', $csrf_token)) 
			{
				$login_log->setResult('csrf错误');
				$this->entityManager->flush();
				return new JsonResponse(['code'=>-1,'msg'=>'csrf错误,请刷新页面后重试']);
			}
			
			$user = $this->entityManager->getRepository(\App\Entity\User::class)->findOneBy(['username'=>$username]);
			if(!$user)
			{
				$login_log->setResult('USER_NOT_EXIST');
				$this->entityManager->flush();
				return new JsonResponse(['code'=>-2,'msg'=>'账号或者密码不正确']);
			}
			
			$roles = $user->getRoles(); 
			if(!in_array('ROLE_MERCHANT',$roles))
			{
				$login_log->setResult('NO_MERCHANT_ROLE');
				$this->entityManager->flush();
				return new JsonResponse(['code'=>-2,'msg'=>'[Access Deny]无权登录系统']);
			}
			
			//检查谷歌验证码
			if(1 == (int)$user->isGoogleBinded())
			{
				if(6 != strlen($google_code))
				{
					echo json_encode(['code'=>-1,'msg'=>'请输入正确的谷歌验证码']);die();
				}
				$google_secret = $user->getGoogleSecret();
				if('' == $google_secret)
				{
					echo json_encode(['code'=>-1,'msg'=>'LoginException:GOOGLE_BINED:SECRET_NULL']);die();
				}
				$google_authenticator = new \App\Utils\GoogleAuthenticator();
				$checkResult = $google_authenticator->verifyCode($google_secret, $google_code, 2);
				if (!$checkResult)
				{
					echo json_encode(['code'=>-1,'msg'=>'谷歌验证码错误']);die();
				}
			}
			
			if($this->passwordHasher->isPasswordValid($user,$password))
			{
				$merchanat = $this->entityManager->getRepository(\App\Entity\Merchant::class)->findOneBy(['uid'=>$user->getId()]);
				if(!$merchanat)
				{
					return new JsonResponse(['code'=>-3,'msg'=>'该账号暂未关联商户信息']);
					exit();
				}
				
				$token = new UsernamePasswordToken($user, 'main', $user->getRoles());
				$this->tokenStorage->setToken($token);
				$event = new \Symfony\Component\Security\Http\Event\InteractiveLoginEvent($request, $token);
				$this->eventDispatcher->dispatch($event);
				
				$login_log->setResult('OK');
				$login_log->setUid($user->getId());
				$login_log->setMid($merchanat->getId());
				$this->entityManager->flush();
				
				$security->login($user, 'json_login', 'main', [(new RememberMeBadge())->enable()]);
				return new JsonResponse(['code'=>0,'msg'=>'LOGIN_SUCCESS']);
			}
			else
			{
				$login_log->setResult('PASS_ERR');
				$this->entityManager->flush();
				return new JsonResponse(['code'=>-3,'msg'=>'账号或者密码错误']);
			}
		}
		else
		{
			echo json_encode(['code'=>-1,'msg'=>'method not allowed']);die();
		}
    }
	
	#[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(Security $security): JsonResponse
    {
        $response = $security->logout();
		//$response = $security->logout(false);
    }
	
	public function GetIp()
    {
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")) {
                $realip = getenv( "HTTP_X_FORWARDED_FOR");
            } elseif (getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            } else {
                $realip = getenv("REMOTE_ADDR");
            }
        }
        return $realip;
    }
}
