<?php

namespace App\Controller;

use App\Entity\Earnings;
use App\Form\EarningsType;
use App\Repository\EarningsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/earnings')]
class EarningsController extends AbstractController
{
    #[Route('/', name: 'app_earnings_index', methods: ['GET'])]
    public function index(EarningsRepository $earningsRepository): Response
    {
        return $this->render('earnings/index.html.twig', [
            'earnings' => $earningsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_earnings_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EarningsRepository $earningsRepository): Response
    {
        $earning = new Earnings();
        $form = $this->createForm(EarningsType::class, $earning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $earningsRepository->save($earning, true);

            return $this->redirectToRoute('app_earnings_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('earnings/new.html.twig', [
            'earning' => $earning,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_earnings_show', methods: ['GET'])]
    public function show(Earnings $earning): Response
    {
        return $this->render('earnings/show.html.twig', [
            'earning' => $earning,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_earnings_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Earnings $earning, EarningsRepository $earningsRepository): Response
    {
        $form = $this->createForm(EarningsType::class, $earning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $earningsRepository->save($earning, true);

            return $this->redirectToRoute('app_earnings_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('earnings/edit.html.twig', [
            'earning' => $earning,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_earnings_delete', methods: ['POST'])]
    public function delete(Request $request, Earnings $earning, EarningsRepository $earningsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$earning->getId(), $request->request->get('_token'))) {
            $earningsRepository->remove($earning, true);
        }

        return $this->redirectToRoute('app_earnings_index', [], Response::HTTP_SEE_OTHER);
    }
}
