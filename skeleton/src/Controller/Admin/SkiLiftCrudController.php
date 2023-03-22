<?php

namespace App\Controller\Admin;

use App\Entity\SkiLift;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SkiLiftCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SkiLift::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('name'),
            TextField::new('type'),
            AssociationField::new("station")
        ];
    }

}
