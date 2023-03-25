<?php

namespace App\Controller;

use App\Entity\CommPost;
use App\Repository\CommPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommunityController extends AbstractController
{
    #[Route('/community', name: 'app_community')]
    public function index(CommPostRepository $commPostRepository): Response
    {
        $commPosts = $commPostRepository->findAll();

        return $this->render('community/index.html.twig', [
            'commPosts' => $commPosts,
        ]);
    }

    #[Route('/community/{sort}', name: 'app_community_category')]
    public function category(CommPostRepository $commPostRepository, $sort): Response
    {
        $commPosts = $commPostRepository->findBy(['category' => $sort]);
        $sort = urlencode($sort);

        return $this->render('community/index.html.twig', [
            'commPosts' => $commPosts,
        ]);
    }

}
