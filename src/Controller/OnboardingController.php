<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OnboardingController extends AbstractController
{
    #[Route('/onboarding', name: 'app_onboarding', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return $this->render('onboarding/index.html.twig', []);
    }
}
