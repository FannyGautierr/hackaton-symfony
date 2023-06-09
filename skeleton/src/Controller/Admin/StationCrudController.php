<?php

namespace App\Controller\Admin;

use App\Entity\Station;
use App\Repository\StationRepository;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bundle\SecurityBundle\Security;


class StationCrudController extends AbstractCrudController
{
    private $security;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager,Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }
    public static function getEntityFqcn(): string
    {
        return Station::class;
    }


    public function configureFields(string $pageName): iterable
    {
        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            return [
                TextField::new('name'),
                TextEditorField::new('description'),
                AssociationField::new('user'),
            ];
        }else{



        return [

            TextField::new('name'),
            TextEditorField::new('description'),

            ImageField::new('logo')
                ->setUploadDir('public/uploads/logo')
                ->setBasePath('uploads/logo')
                ->setUploadedFileNamePattern('[slug]-[randomhash].[extension]')
                ->setFormTypeOptions([
                    'attr'=>[
                        'accept'=>'image/*'
                    ]
                ]),
        ];
        }
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $userId = $this->security->getUser()->getId();
        if($this->isGranted('ROLE_SUPER_ADMIN')){
            return $this->entityManager->createQueryBuilder()
                ->select('s')
                ->from('App\Entity\Station', 's');
        }else{


        return $this->entityManager->createQueryBuilder()
            ->select('s')
            ->from('App\Entity\Station', 's')
            ->where('s.user = :userId')
            ->setParameter('userId', $userId);
    }
    }

}
