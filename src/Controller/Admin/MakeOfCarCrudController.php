<?php

namespace App\Controller\Admin;

use App\Entity\Annonce\Vehicule\Voitures\MakeOfCar;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MakeOfCarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MakeOfCar::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
        ];
    }

}
