<?php

namespace App\Controller;

use App\Entity\UnexpectedIncomes;
use App\Form\UnexpectedIncomesType;
use App\Repository\UnexpectedIncomesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/unexpected-incomes')]
class UnexpectedIncomesController extends AbstractController
{
    #[Route('/', name: 'app_unexpected_incomes_index', methods: ['GET'])]
    public function index(UnexpectedIncomesRepository $unexpectedIncomesRepository): Response
    {
        return $this->render('unexpected_incomes/index.html.twig', [
            'unexpected_incomes' => $unexpectedIncomesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_unexpected_incomes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UnexpectedIncomesRepository $unexpectedIncomesRepository): Response
    {
        $unexpectedIncome = new UnexpectedIncomes();
        $form = $this->createForm(UnexpectedIncomesType::class, $unexpectedIncome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $unexpectedIncomesRepository->save($unexpectedIncome, true);

            return $this->redirectToRoute('app_unexpected_incomes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('unexpected_incomes/new.html.twig', [
            'unexpected_income' => $unexpectedIncome,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_unexpected_incomes_show', methods: ['GET'])]
    public function show(UnexpectedIncomes $unexpectedIncome): Response
    {
        return $this->render('unexpected_incomes/show.html.twig', [
            'unexpected_income' => $unexpectedIncome,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_unexpected_incomes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UnexpectedIncomes $unexpectedIncome, UnexpectedIncomesRepository $unexpectedIncomesRepository): Response
    {
        $form = $this->createForm(UnexpectedIncomesType::class, $unexpectedIncome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $unexpectedIncomesRepository->save($unexpectedIncome, true);

            return $this->redirectToRoute('app_unexpected_incomes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('unexpected_incomes/edit.html.twig', [
            'unexpected_income' => $unexpectedIncome,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_unexpected_incomes_delete', methods: ['POST'])]
    public function delete(Request $request, UnexpectedIncomes $unexpectedIncome, UnexpectedIncomesRepository $unexpectedIncomesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $unexpectedIncome->getId(), $request->request->get('_token'))) {
            $unexpectedIncomesRepository->remove($unexpectedIncome, true);
        }

        return $this->redirectToRoute('app_unexpected_incomes_index', [], Response::HTTP_SEE_OTHER);
    }
}
