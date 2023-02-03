<?php

namespace App\Controller;

use App\Entity\OccasionalSpendings;
use App\Form\OccasionalSpendingsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OccasionalSpendingsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
#[Route('/occasional-spendings')]
class OccasionalSpendingsController extends AbstractController
{
    #[Route('/', name: 'app_occasional_spendings_index', methods: ['GET'])]
    public function index(OccasionalSpendingsRepository $occasionalSpendingsRepository): Response
    {
        return $this->render('occasional_spendings/index.html.twig', [
            'occasionalSpendings' => $occasionalSpendingsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_occasional_spendings_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OccasionalSpendingsRepository $occasionalSpendingsRepository): Response
    {
        /** @var \App\Entity\User */
        $user = $this->getUser();
        $occasionalSpending = new OccasionalSpendings();
        $form = $this->createForm(OccasionalSpendingsType::class, $occasionalSpending);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $occasionalSpending->setUser($user);
            $occasionalSpendingsRepository->save($occasionalSpending, true);

            return $this->redirectToRoute('app_occasional_spendings_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('occasional_spendings/new.html.twig', [
            'occasional_spending' => $occasionalSpending,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_occasional_spendings_show', methods: ['GET'])]
    public function show(OccasionalSpendings $occasionalSpending): Response
    {
        return $this->render('occasional_spendings/show.html.twig', [
            'occasional_spending' => $occasionalSpending,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_occasional_spendings_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        OccasionalSpendings $occasionalSpending,
        OccasionalSpendingsRepository $occasionalSpendingsRepository
    ): Response {
        $form = $this->createForm(OccasionalSpendingsType::class, $occasionalSpending);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $occasionalSpendingsRepository->save($occasionalSpending, true);

            return $this->redirectToRoute('app_occasional_spendings_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('occasional_spendings/edit.html.twig', [
            'occasional_spending' => $occasionalSpending,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_occasional_spendings_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        OccasionalSpendings $occasionalSpending,
        OccasionalSpendingsRepository $occasionalSpendingsRepository
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $occasionalSpending->getId(), $request->request->get('_token'))) {
            $occasionalSpendingsRepository->remove($occasionalSpending, true);
        }

        return $this->redirectToRoute('app_occasional_spendings_index', [], Response::HTTP_SEE_OTHER);
    }
}
