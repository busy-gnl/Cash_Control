<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\EarningsRepository;
use App\Repository\MonthlyExpensesRepository;
use App\Repository\OccasionalSpendingsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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

    #[Route('/budget-tracking', name: 'app_budget_tracking')]
    public function budgetTracking(
        EarningsRepository $earningsRepository,
        MonthlyExpensesRepository $monthlyExpensesRepository,
        OccasionalSpendingsRepository $occasionalSpendingsRepository
    ): Response {
        return $this->render('dashboard/budget_tracking.html.twig', [
            'earnings' => $earningsRepository->findAll(),
            'monthlyExpenses' => $monthlyExpensesRepository->findAll(),
            'occasionalSpendings' => $occasionalSpendingsRepository->findAll(),
        ]);
    }
}
