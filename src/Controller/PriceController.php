<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PriceController extends AbstractController
{
    #[Route('/price', name: 'app_price')]
    public function index(UserRepository $userRepo): Response
    {
        $price = $userRepo->findAll();

        return $this->render('price/index.html.twig', [
            'price' => $price,
        ]);
    }
}
