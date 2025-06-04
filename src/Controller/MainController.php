<?php

namespace App\Controller;


use App\Repository\FaqRepository;
use App\Repository\PostRepository;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MainController extends AbstractController
{

   #[Route('/main', name: 'app_main')]
    public function index(PostRepository $postsRepo, UserRepository $userRepo,): Response
    {
        // $team = $teamRepo->findAll();
        $posts = $postsRepo->findAll();
        $comments = $userRepo->findAll();
      //  $faq = $faqRepo->findAll();

        return $this->render('main/index.html.twig', [
           // 'team' => $team,
            'posts' => $posts,
            'comments' => $comments,
            //'faq' => $faq,
        ]);
    }


}

