<?php

namespace App\Controller\Admin;

use App\Entity\SkiLift;
use App\Entity\SkiTrack;
use App\Repository\SkiLiftRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use Symfony\Bundle\SecurityBundle\Security;

class SkiTrackCrudController extends AbstractCrudController
{

    private $security;
    private $entityManager;
    private $skiLiftRepository;

    public function __construct(EntityManagerInterface $entityManager,Security $security, SkiLiftRepository $skiLiftRepository)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
        $this->skiLiftRepository = $skiLiftRepository;
    }
    public static function getEntityFqcn(): string
    {
        return SkiTrack::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $id = $this->security->getUser()->getStation()->getId();

        return [

            TextField::new('name'),
            TextField::new('difficulty'),
            AssociationField::new('Station'),
            AssociationField::new('skiLift')->setQueryBuilder(function (QueryBuilder $queryBuilder) use ($id) {
                return $queryBuilder->select('sl')
                    ->from(SkiLift::class, 'sl')
                    ->where('sl.station = :id')
                    ->setParameter('id', $id);
            }),
            TimeField::new("open"),
            TimeField::new("close"),
            TextField::new('information'),
            BooleanField::new('exception')


        ];
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $stationId = $this->security->getUser()->getStation()->getId();

        return $this->entityManager->createQueryBuilder()
            ->select('st')
            ->from('App\Entity\SkiTrack', 'st')
            ->where('st.Station = :stationId')
            ->setParameter('stationId', $stationId);
    }


}
