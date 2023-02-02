<?php

namespace App\Controller;

use App\Repository\InterventionRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(InterventionRepository $interventionRepository): Response
    {
        $today = new DateTime('now');
        $today = $today->format("Y-m-d");
        $interventions = $interventionRepository->interventionsAtDate($today);

        return $this->render('home/index.html.twig', [
            'interventions' => $interventions,
        ]);
    }
}