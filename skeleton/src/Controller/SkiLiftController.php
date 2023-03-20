<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SkiLiftController extends AbstractController
{
    #[Route('/ski/lift', name: 'app_ski_lift')]
    public function index(): Response
    {
        return $this->render('ski_lift/index.html.twig', [
            'controller_name' => 'SkiLiftController',
        ]);
    }
}
