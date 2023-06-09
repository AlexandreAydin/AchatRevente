<?php

namespace App\Controller\Admin;

use App\Entity\MakeCar;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MakeCarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MakeCar::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            AssociationField::new('subCategorie')
        ];
    }

}
