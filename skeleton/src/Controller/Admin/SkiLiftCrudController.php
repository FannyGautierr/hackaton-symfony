<?php

namespace App\Controller\Admin;

use App\Entity\SkiLift;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

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
            TimeField::new('open'),
            TimeField::new('close'),
            TextField::new('information')
        ];
    }

}
