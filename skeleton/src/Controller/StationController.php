<?php

namespace App\Controller;

use App\Entity\Station;
use App\Repository\StationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StationController extends AbstractController
{
    #[Route('/station/{id}', name: 'app_station')]
    public function index( $id,StationRepository $stationRepository): Response
    {
        $stations = $stationRepository->find($id);
        $days = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];

        return $this->render('station/index.html.twig', [
            'controller_name' => 'StationController',
            'stations'=>$stations,
            'days'=> $days
        ]);
    }

}
