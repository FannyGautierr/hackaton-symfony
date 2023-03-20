<?php

namespace App\Controller\Admin;

use App\Entity\SkiTrack;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SkiTrackCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SkiTrack::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }

}
