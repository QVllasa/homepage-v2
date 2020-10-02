<?php

namespace App\Controller\Admin;

use App\Entity\Banner;
use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Experience;
use App\Entity\ProfilImage;
use App\Entity\Project;
use App\Entity\Skill;
use App\Entity\Stack;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Homepage Backend');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-dot-circle');
         yield MenuItem::linkToCrud('Skills', 'fa fa-dot-circle', Skill::class);
        yield MenuItem::linkToCrud('Banners', 'fa fa-dot-circle', Banner::class);
        yield MenuItem::linkToCrud('Categories', 'fa fa-dot-circle', Category::class);
        yield MenuItem::linkToCrud('Clients', 'fa fa-dot-circle', Client::class);
        yield MenuItem::linkToCrud('Experiences', 'fa fa-dot-circle', Experience::class);
        yield MenuItem::linkToCrud('Profile Image', 'fa fa-dot-circle', ProfilImage::class);
        yield MenuItem::linkToCrud('Projects', 'fa fa-dot-circle', Project::class);
        yield MenuItem::linkToCrud('Stacks', 'fa fa-dot-circle', Stack::class);
    }
}
