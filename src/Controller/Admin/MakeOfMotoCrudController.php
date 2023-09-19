<?php

namespace App\Controller\Admin;

use App\Entity\Annonce\Vehicule\Motos\MakeOfMoto;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MakeOfMotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MakeOfMoto::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
          TextField::new('name'),
        ];
    }
    
}
