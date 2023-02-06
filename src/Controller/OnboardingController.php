<?php

namespace App\Controller;

use App\Entity\Earnings;
use App\Form\EarningsType;
use App\Entity\MonthlyExpenses;
use App\Form\MonthlyExpensesType;
use App\Repository\EarningsRepository;
use App\Repository\MonthlyExpensesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
class OnboardingController extends AbstractController
{
    #[Route('/onboarding-earnings', name: 'app_onboarding_earnings', methods: ['GET', 'POST'])]
    public function onboardingEarnings(
        Request $request,
        EarningsRepository $earningsRepository,
    ): Response {
        /** @var \App\Entity\User */
        $user = $this->getUser();
        $earning = new Earnings();
        $earningsform = $this->createForm(EarningsType::class, $earning);
        $earningsform->handleRequest($request);

        if ($earningsform->isSubmitted() && $earningsform->isValid()) {
            $earning->setUser($user);
            $earningsRepository->save($earning, true);
        }

        return $this->render('onboarding/earnings.html.twig', [
            'earningsform' => $earningsform->createView(),
        ]);
    }

    #[Route('/onboarding-expenses', name: 'app_onboarding_expenses', methods: ['GET', 'POST'])]
    public function onboardingExpenses(
        Request $request,
        MonthlyExpensesRepository $monthlyExpensesRepository
    ): Response {
        /** @var \App\Entity\User */
        $user = $this->getUser();

        $monthlyExpense = new MonthlyExpenses();
        $expensesform = $this->createForm(MonthlyExpensesType::class, $monthlyExpense);
        $expensesform->handleRequest($request);

        if ($expensesform->isSubmitted() && $expensesform->isValid()) {
            $monthlyExpense->setUser($user);
            $monthlyExpensesRepository->save($monthlyExpense, true);
        }

        return $this->render('onboarding/expenses.html.twig', [
            'expensesform' => $expensesform->createView(),
        ]);
    }
}
