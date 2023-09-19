<?php

namespace App\Controller\Admin;

use App\Entity\Annonce\Vehicule\Motos\MotoModel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MotoModelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MotoModel::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            AssociationField::new('makeOfMoto')
        ];
    }
    
}
