<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('login/index.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): void
    {
    }

    #[Route('/login/redirect', name: 'app_login_redirect')]
    #[IsGranted('ROLE_USER')]
    public function redirectAfterLogin(
        EntityManagerInterface $entityManager
    ): Response {
        if ($this->isGranted('ROLE_USER')) {
            /** @var \App\Entity\User */
            $user = $this->getUser();
            if ($user->isFirstLogin() == true) {
                $user->setFirstLogin(false);
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirectToRoute('app_onboarding', [], Response::HTTP_SEE_OTHER);
            }

            return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
        }
        return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
    }
}
