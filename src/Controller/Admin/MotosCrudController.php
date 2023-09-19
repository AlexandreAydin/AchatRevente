<?php

namespace App\Controller\Admin;

use App\Entity\Annonce\Vehicule\Motos;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MotosCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Motos::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
