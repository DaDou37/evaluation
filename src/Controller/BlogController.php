<?php

namespace App\Controller;

use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(BlogRepository $blogRepo): Response
    {
        $blog = $blogRepo->findAll();

        return $this->render('blog/index.html.twig', [
            'blog' => $blog,
        ]);
    }
}
