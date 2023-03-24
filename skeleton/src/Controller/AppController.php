<?php

namespace App\Controller;

use App\Entity\Station;
use App\Repository\DomainRepository;
use App\Repository\StationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'app_app')]
    public function index(DomainRepository $domainRepository, StationRepository $stationRepository): Response
    {
        $domain = $domainRepository->findAll();
        $station = $stationRepository->findAll();

        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
            'domains'=>$domain,
            'stations'=>$station
        ]);
    }
}
