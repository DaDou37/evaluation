<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ServiceController extends AbstractController
{
    #[Route('/service', name: 'app_service')]
    public function index(UserRepository $userRepo): Response
    {
        $service = $userRepo->findAll();

        return $this->render('service/index.html.twig', [
            'service' => $service,
        ]);
    }
}
