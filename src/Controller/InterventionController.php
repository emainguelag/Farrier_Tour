<?php

namespace App\Controller;

use App\Entity\Intervention;
use App\Form\InterventionType;
use App\Form\MyTourType;
use App\Repository\InterventionRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/intervention')]
class InterventionController extends AbstractController
{
    #[Route('/', name: 'app_intervention_index', methods: ['GET'])]
    public function index(InterventionRepository $interventionRepository): Response
    {
        return $this->render('intervention/index.html.twig', [
            'interventions' => $interventionRepository->interventionsWithCity(),
        ]);
    }

    #[Route('/tour', name: 'app_intervention_tour', methods: ['GET', 'POST'])]
    public function myTour(InterventionRepository $interventionRepository, Request $request): Response
    {
        $today = new DateTime('now');
        $today = $today->format("Y-m-d");

        $form = $this->createForm(MyTourType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['Date']->format("Y-m-d");
            $interventions = $interventionRepository->interventionsAtDate($search);
        } else {
            $interventions = $interventionRepository->interventionsWithCityLimit($today);
        }

        return $this->render('intervention/tour.html.twig', [
            'interventions' => $interventions,
            'form' => $form,
        ]);
    }

    #[Route('/new', name: 'app_intervention_new', methods: ['GET', 'POST'])]
    public function new(Request $request, InterventionRepository $interventionRepository): Response
    {
        $intervention = new Intervention();
        $form = $this->createForm(InterventionType::class, $intervention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $interventionRepository->save($intervention, true);

            return $this->redirectToRoute('app_intervention_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('intervention/new.html.twig', [
            'intervention' => $intervention,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_intervention_show', methods: ['GET'])]
    public function show(Intervention $intervention): Response
    {
        return $this->render('intervention/show.html.twig', [
            'intervention' => $intervention,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_intervention_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Intervention $intervention, InterventionRepository $interventionRepository): Response
    {
        $form = $this->createForm(InterventionType::class, $intervention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $interventionRepository->save($intervention, true);

            return $this->redirectToRoute('app_intervention_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('intervention/edit.html.twig', [
            'intervention' => $intervention,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_intervention_delete', methods: ['POST'])]
    public function delete(Request $request, Intervention $intervention, InterventionRepository $interventionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$intervention->getId(), $request->request->get('_token'))) {
            $interventionRepository->remove($intervention, true);
        }

        return $this->redirectToRoute('app_intervention_index', [], Response::HTTP_SEE_OTHER);
    }
}
