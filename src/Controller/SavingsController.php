<?php

namespace App\Controller;

use App\Entity\Savings;
use App\Form\SavingsType;
use App\Repository\SavingsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
#[Route('/savings')]
class SavingsController extends AbstractController
{
    #[Route('/', name: 'app_savings_index', methods: ['GET'])]
    public function index(SavingsRepository $savingsRepository): Response
    {
        return $this->render('savings/index.html.twig', [
            'savings' => $savingsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_savings_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SavingsRepository $savingsRepository): Response
    {
        $saving = new Savings();
        $form = $this->createForm(SavingsType::class, $saving);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $savingsRepository->save($saving, true);

            return $this->redirectToRoute('app_savings_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('savings/new.html.twig', [
            'saving' => $saving,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_savings_show', methods: ['GET'])]
    public function show(Savings $saving): Response
    {
        return $this->render('savings/show.html.twig', [
            'saving' => $saving,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_savings_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Savings $saving, SavingsRepository $savingsRepository): Response
    {
        $form = $this->createForm(SavingsType::class, $saving);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $savingsRepository->save($saving, true);

            return $this->redirectToRoute('app_savings_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('savings/edit.html.twig', [
            'saving' => $saving,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_savings_delete', methods: ['POST'])]
    public function delete(Request $request, Savings $saving, SavingsRepository $savingsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $saving->getId(), $request->request->get('_token'))) {
            $savingsRepository->remove($saving, true);
        }

        return $this->redirectToRoute('app_savings_index', [], Response::HTTP_SEE_OTHER);
    }
}
