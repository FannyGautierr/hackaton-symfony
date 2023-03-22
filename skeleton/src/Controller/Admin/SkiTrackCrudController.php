<?php

namespace App\Controller\Admin;

use App\Entity\SkiTrack;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use Symfony\Component\Validator\Constraints\Time;

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
            TimeField::new('open'),
            TimeField::new('close'),
            BooleanField::new('exception'),
            TextField::new('information')

        ];
    }

}
