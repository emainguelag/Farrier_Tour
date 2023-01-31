<?php

namespace App\Controller;

use App\Entity\Hoster;
use App\Form\HosterType;
use App\Repository\HosterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/hoster')]
class HosterController extends AbstractController
{
    #[Route('/', name: 'app_hoster_index', methods: ['GET'])]
    public function index(HosterRepository $hosterRepository): Response
    {
        return $this->render('hoster/index.html.twig', [
            'hosters' => $hosterRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_hoster_new', methods: ['GET', 'POST'])]
    public function new(Request $request, HosterRepository $hosterRepository): Response
    {
        $hoster = new Hoster();
        $form = $this->createForm(HosterType::class, $hoster);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hosterRepository->save($hoster, true);

            return $this->redirectToRoute('app_hoster_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hoster/new.html.twig', [
            'hoster' => $hoster,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hoster_show', methods: ['GET'])]
    public function show(Hoster $hoster): Response
    {
        return $this->render('hoster/show.html.twig', [
            'hoster' => $hoster,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_hoster_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Hoster $hoster, HosterRepository $hosterRepository): Response
    {
        $form = $this->createForm(HosterType::class, $hoster);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hosterRepository->save($hoster, true);

            return $this->redirectToRoute('app_hoster_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hoster/edit.html.twig', [
            'hoster' => $hoster,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hoster_delete', methods: ['POST'])]
    public function delete(Request $request, Hoster $hoster, HosterRepository $hosterRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hoster->getId(), $request->request->get('_token'))) {
            $hosterRepository->remove($hoster, true);
        }

        return $this->redirectToRoute('app_hoster_index', [], Response::HTTP_SEE_OTHER);
    }
}
