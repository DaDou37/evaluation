<?php

namespace App\Controller;

use App\Form\NewsletterForm;
use App\Service\NewsletterService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class NewsletterController extends AbstractController
{
    #[Route('/newsletter', name: 'newsletter')]
public function subscribe(Request $request, NewsletterService $newsletterService): Response
{
    $form = $this->createForm(NewsletterForm::class);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $data = $form->getData();
        $newsletterService->subscribe($data['email']);
    }

    return $this->render('newsletter/subscribe.html.twig', [
        'form' => $form->createView(),
    ]);
}
}
