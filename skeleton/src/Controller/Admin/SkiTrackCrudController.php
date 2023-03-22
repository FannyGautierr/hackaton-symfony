<?php

namespace App\Controller\Admin;

use App\Entity\SkiTrack;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SkiTrackCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SkiTrack::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('name'),
            TextField::new('difficulty'),
            AssociationField::new("station")
        ];
    }

}
