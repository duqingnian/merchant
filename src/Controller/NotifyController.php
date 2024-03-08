<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class NotifyController extends BaseController
{

    #[Route('/notify.api', name: 'notify')]
    public function index(Request $request): JsonResponse
    {
        return $this->dispatch($request);
    }
	
	#[Route('/api_notify', name: 'api_notify')]
    public function api_notify(Request $request): JsonResponse
    {
        echo 'success';
		exit();
    }
	
}


