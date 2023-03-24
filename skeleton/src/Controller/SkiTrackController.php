<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SkiTrackController extends AbstractController
{
    #[Route('/pistes', name: 'app_ski_track')]
    public function index(): Response
    {
        return $this->render('ski_track/index.html.twig', [
            'controller_name' => 'SkiTrackController',
        ]);
    }
}
