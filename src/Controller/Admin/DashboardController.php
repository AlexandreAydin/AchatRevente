<?php

namespace App\Controller\Admin;

use App\Entity\Annonce\Article;
use App\Entity\Annonce\Categorie;
use App\Entity\Annonce\SubCategorie;
use App\Entity\Annonce\Vehicule\Voitures\MakeOfCar;
use App\Entity\Annonce\Vehicule\Voitures\CarModel;
use App\Entity\User;
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
        yield MenuItem::linkToCrud('Catégorie', 'fa-solid fa-users', Categorie::class);
        yield MenuItem::linkToCrud('Sous Catégorie', 'fa-solid fa-users', SubCategorie::class);
        // yield MenuItem::linkToCrud('Sous Catégorie', 'fa-solid fa-users', MakeOfCar::class);
        // yield MenuItem::linkToCrud('Sous Catégorie', 'fa-solid fa-users', CarModel::class);
        yield MenuItem::subMenu('Voitures', 'fa-solid fa-car')->setSubItems([
            MenuItem::linkToCrud('Sous Catégorie', 'fa-solid fa-users', MakeOfCar::class),
            MenuItem::linkToCrud('Sous Catégorie', 'fa-solid fa-users', CarModel::class),
        ]);
    }
}
