<?php

namespace App\Controller;

use App\Entity\Farrier;
use App\Form\FarrierType;
use App\Repository\FarrierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/farrier')]
class FarrierController extends AbstractController
{
    #[Route('/', name: 'app_farrier_index', methods: ['GET'])]
    public function index(FarrierRepository $farrierRepository): Response
    {
        return $this->render('farrier/index.html.twig', [
            'farriers' => $farrierRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_farrier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FarrierRepository $farrierRepository): Response
    {
        $farrier = new Farrier();
        $form = $this->createForm(FarrierType::class, $farrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $farrierRepository->save($farrier, true);

            return $this->redirectToRoute('app_farrier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('farrier/new.html.twig', [
            'farrier' => $farrier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_farrier_show', methods: ['GET'])]
    public function show(Farrier $farrier): Response
    {
        return $this->render('farrier/show.html.twig', [
            'farrier' => $farrier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_farrier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Farrier $farrier, FarrierRepository $farrierRepository): Response
    {
        $form = $this->createForm(FarrierType::class, $farrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $farrierRepository->save($farrier, true);

            return $this->redirectToRoute('app_farrier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('farrier/edit.html.twig', [
            'farrier' => $farrier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_farrier_delete', methods: ['POST'])]
    public function delete(Request $request, Farrier $farrier, FarrierRepository $farrierRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$farrier->getId(), $request->request->get('_token'))) {
            $farrierRepository->remove($farrier, true);
        }

        return $this->redirectToRoute('app_farrier_index', [], Response::HTTP_SEE_OTHER);
    }
}
