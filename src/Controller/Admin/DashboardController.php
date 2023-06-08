<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\MakeCar;
use App\Entity\ModelCar;
use App\Entity\User;
use App\Entity\Vehicle;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        return $this->render('pages/admin/dashboard.html.twig');

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('AchatRevente');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        
        yield MenuItem::linkToCrud('Article', 'fa-solid fa-quote-right', Article::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-users', User::class);
        yield MenuItem::linkToCrud('Categorie', 'fa-solid fa-users', Categorie::class);
        yield MenuItem::linkToCrud('Véhicule', 'fa-solid fa-users', Vehicle::class);
        yield MenuItem::linkToCrud('Marque', 'fa-solid fa-users', MakeCar::class);
        yield MenuItem::linkToCrud('Modéle', 'fa-solid fa-users', ModelCar::class);
    }
}
