<?php

namespace App\Controller\Admin;

use App\Entity\SkiLift;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use Symfony\Bundle\SecurityBundle\Security;

class SkiLiftCrudController extends AbstractCrudController
{   private $security;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager,Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }
    public static function getEntityFqcn(): string
    {
        return SkiLift::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('name'),
            TextField::new('type'),
            AssociationField::new("station"),
            TimeField::new("open"),
            TimeField::new("close"),
            TextField::new('information')


        ];
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $stationId = $this->security->getUser()->getStation()->getId();

        return $this->entityManager->createQueryBuilder()
            ->select('sl')
            ->from('App\Entity\SkiLift', 'sl')
            ->where('sl.station = :stationId')
            ->setParameter('stationId', $stationId);
    }

}
