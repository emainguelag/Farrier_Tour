<?php

namespace App\Controller;

use App\Entity\Horse;
use App\Form\HorseType;
use App\Repository\HorseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/horse')]
class HorseController extends AbstractController
{
    #[Route('/', name: 'app_horse_index', methods: ['GET'])]
    public function index(HorseRepository $horseRepository): Response
    {
        return $this->render('horse/index.html.twig', [
            'horses' => $horseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_horse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, HorseRepository $horseRepository): Response
    {
        $horse = new Horse();
        $form = $this->createForm(HorseType::class, $horse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $horseRepository->save($horse, true);

            return $this->redirectToRoute('app_horse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('horse/new.html.twig', [
            'horse' => $horse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_horse_show', methods: ['GET'])]
    public function show(Horse $horse): Response
    {
        return $this->render('horse/show.html.twig', [
            'horse' => $horse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_horse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Horse $horse, HorseRepository $horseRepository): Response
    {
        $form = $this->createForm(HorseType::class, $horse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $horseRepository->save($horse, true);

            return $this->redirectToRoute('app_horse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('horse/edit.html.twig', [
            'horse' => $horse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_horse_delete', methods: ['POST'])]
    public function delete(Request $request, Horse $horse, HorseRepository $horseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$horse->getId(), $request->request->get('_token'))) {
            $horseRepository->remove($horse, true);
        }

        return $this->redirectToRoute('app_horse_index', [], Response::HTTP_SEE_OTHER);
    }
}
