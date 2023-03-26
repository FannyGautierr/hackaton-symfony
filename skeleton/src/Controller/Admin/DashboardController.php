<?php

namespace App\Controller\Admin;

use App\Controller\StationController;
use App\Entity\SkiLift;
use App\Entity\SkiTrack;
use App\Entity\Station;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(StationCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Skeleton');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            //yield MenuItem::linkToCrud('Users', 'fas fa-list', User::class);

        }

        yield MenuItem::linkToCrud('Stations', 'fas fa-list', Station::class);
        yield MenuItem::linkToCrud('Ski Lifts', 'fa-ski-lift', SkiLift::class);
        yield MenuItem::linkToCrud('Ski Tracks', 'fas fa-list', SkiTrack::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-list', User::class);

    }
}
