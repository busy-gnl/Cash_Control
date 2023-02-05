<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\OccasionalSpendings;
use App\Form\OccasionalSpendingsType;
use App\Repository\EarningsRepository;
use App\Repository\MonthlyExpensesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OccasionalSpendingsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(
        EarningsRepository $earningsRepository,
        MonthlyExpensesRepository $monthlyExpensesRepository
    ): Response {
        return $this->render('dashboard/index.html.twig', [
            'earnings' => $earningsRepository->findAll(),
            'monthlyExpenses' => $monthlyExpensesRepository->findAll(),
        ]);
    }

    #[Route('/budget-tracking', name: 'app_budget_tracking', methods: ['GET', 'POST'])]
    public function budgetTracking(
        Request $request,
        EarningsRepository $earningsRepository,
        MonthlyExpensesRepository $monthlyExpensesRepository,
        OccasionalSpendingsRepository $occasionalSpendingsRepository
    ): Response {
        /** @var \App\Entity\User */
        $user = $this->getUser();
        $occasionalSpending = new OccasionalSpendings();
        $occasionalSpendingsForm = $this->createForm(OccasionalSpendingsType::class, $occasionalSpending);
        $occasionalSpendingsForm->handleRequest($request);

        if ($occasionalSpendingsForm->isSubmitted() && $occasionalSpendingsForm->isValid()) {
            $occasionalSpending->setUser($user);
            $occasionalSpendingsRepository->save($occasionalSpending, true);
        }

        return $this->render('dashboard/budget_tracking.html.twig', [
            'earnings' => $earningsRepository->findAll(),
            'monthlyExpenses' => $monthlyExpensesRepository->findAll(),
            'occasionalSpendings' => $occasionalSpendingsRepository->findAll(),
            'occasionalSpendingsForm' => $occasionalSpendingsForm->createView(),
        ]);
    }
}
