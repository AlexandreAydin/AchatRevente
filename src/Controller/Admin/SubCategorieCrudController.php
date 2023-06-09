<?php

namespace App\Controller\Admin;

use App\Entity\SubCategorie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SubCategorieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SubCategorie::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            AssociationField::new('categorie')
        ];
    }
}
