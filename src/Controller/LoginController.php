<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(UserRepository $userRepo): Response
    {
        $login = $userRepo->findAll();
        return $this->render('login/index.html.twig', [
            'login' => $login,
        ]);
    }
}
