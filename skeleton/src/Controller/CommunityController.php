<?php

namespace App\Controller;

use App\Entity\CommPost;
use App\Repository\CommPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

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

    #[Route('/community/sort/{sort}', name: 'app_community_category')]
    public function category(CommPostRepository $commPostRepository, $sort): Response
    {
        $commPosts = $commPostRepository->findBy(['category' => $sort]);
        $sort = urldecode($sort);

        return $this->render('community/index.html.twig', [
            'commPosts' => $commPosts,
            'sort' => $sort,
        ]);
    }

    #[Route('/community/search', name: 'app_community_search')]
    public function search(CommPostRepository $commPostRepository, Request $request): Response
    {

        $query = $request->request->get('q');
        $query = urldecode($query);
        $results = $commPostRepository->createQueryBuilder('e')
            ->where('e.content LIKE :query')
            ->setParameter('query', '%'.$query.'%')
            ->getQuery()
            ->getResult();

        return $this->render('community/index.html.twig', [
            'commPosts' => $results,
        ]);
    }

    #[Route('/add-post', name: 'app_community_addPost')]
    public function addPost(Request $request, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();
        $category = $request->request->get('category');
        $content = $request->request->get('content');

        $post = new CommPost();
        $post->setUserId($user);
        $post->setDate(new DateTime('now', new \DateTimeZone('Europe/Paris')));
        $post->setCategory($category);
        $post->setContent($content);

        $manager->persist($post);
        $manager->flush();

        return  $this->redirect('/community');
    }
}
