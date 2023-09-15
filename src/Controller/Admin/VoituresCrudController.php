<?php

namespace App\Controller\Admin;

use App\Entity\Annonce\Vehicule\Voitures;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VoituresCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Voitures::class;
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
