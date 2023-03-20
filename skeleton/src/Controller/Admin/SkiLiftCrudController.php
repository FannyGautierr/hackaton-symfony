<?php

namespace App\Controller\Admin;

use App\Entity\SkiLift;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SkiLiftCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SkiLift::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }

}
