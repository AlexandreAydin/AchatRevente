<?php

namespace App\Controller\Admin;

use App\Entity\Annonce\Vehicule\Voitures\CarModel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CarModelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CarModel::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
         return [
            TextField::new('name'),
            AssociationField::new('makeOfCar')
        ];
    }
    
}
