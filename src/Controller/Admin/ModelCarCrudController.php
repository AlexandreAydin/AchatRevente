<?php

namespace App\Controller\Admin;

use App\Entity\ModelCar;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ModelCarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ModelCar::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            AssociationField::new('makeCar')
        ];
    }
}
