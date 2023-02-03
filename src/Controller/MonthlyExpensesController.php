<?php

namespace App\Controller;

use App\Entity\MonthlyExpenses;
use App\Form\MonthlyExpensesType;
use App\Repository\MonthlyExpensesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
#[Route('/monthly-expenses')]
class MonthlyExpensesController extends AbstractController
{
    #[Route('/', name: 'app_monthly_expenses_index', methods: ['GET'])]
    public function index(MonthlyExpensesRepository $monthlyExpensesRepository): Response
    {
        return $this->render('monthly_expenses/index.html.twig', [
            'monthlyExpenses' => $monthlyExpensesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_monthly_expenses_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MonthlyExpensesRepository $monthlyExpensesRepository): Response
    {
        /** @var \App\Entity\User */
        $user = $this->getUser();
        $monthlyExpense = new MonthlyExpenses();
        $form = $this->createForm(MonthlyExpensesType::class, $monthlyExpense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $monthlyExpense->setUser($user);
            $monthlyExpensesRepository->save($monthlyExpense, true);

            return $this->redirectToRoute('app_monthly_expenses_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('monthly_expenses/new.html.twig', [
            'monthly_expense' => $monthlyExpense,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_monthly_expenses_show', methods: ['GET'])]
    public function show(MonthlyExpenses $monthlyExpense): Response
    {
        return $this->render('monthly_expenses/show.html.twig', [
            'monthly_expense' => $monthlyExpense,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_monthly_expenses_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        MonthlyExpenses $monthlyExpense,
        MonthlyExpensesRepository $monthlyExpensesRepository
    ): Response {
        $form = $this->createForm(MonthlyExpensesType::class, $monthlyExpense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $monthlyExpensesRepository->save($monthlyExpense, true);

            return $this->redirectToRoute('app_monthly_expenses_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('monthly_expenses/edit.html.twig', [
            'monthly_expense' => $monthlyExpense,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_monthly_expenses_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        MonthlyExpenses $monthlyExpense,
        MonthlyExpensesRepository $monthlyExpensesRepository
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $monthlyExpense->getId(), $request->request->get('_token'))) {
            $monthlyExpensesRepository->remove($monthlyExpense, true);
        }

        return $this->redirectToRoute('app_monthly_expenses_index', [], Response::HTTP_SEE_OTHER);
    }
}
