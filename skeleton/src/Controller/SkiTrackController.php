<?php

namespace App\Controller;

use App\Repository\SkiTrackRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SkiTrackController extends AbstractController
{
    #[Route('/pistes/{id}', name: 'associated_track')]
    public function index($id, SkiTrackRepository $repository, Request $request): Response
    {
        $tracks = $repository->findBy(['skiLift' => $id]);

        if ($tracks == null) {
            $this->addFlash('warning', 'There are no tracks available for this ski lift.');
            $referer = $request->headers->get('referer');
            return $this->redirect($referer);
                }

        return $this->render('ski_track/index.html.twig', [
            'controller_name' => 'SkiTrackController',
            'tracks'=>$tracks

        ]);
    }
}
