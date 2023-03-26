<?php

namespace App\Form;

use App\Entity\CommPost;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewPostFormType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {


       //$user = $this->security->getUser();
       //$currentDate = new \DateTime();

        $builder
            //->add('user_id', HiddenType::class, [
            //    'data' => $user->getId(),
            //])
            //->add('date', HiddenType::class, [
            //    'data' => $currentDate->format('Y-m-d H:i:s'),
            //])
            ->add('content', TextareaType::class)
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'Infos officielles' => 'infos',
                    'Événements' => 'events',
                    'Concours' => 'contests',
                    'Bons plans' => 'deals',
                    'Pour les djeuns' => 'youth',
                    'Coin photos' => 'photos',
                    'Objets perdus' => 'lost',
                ]
            ])
            ->add('image', FileType::class, [
                'mapped' => false,
                'required' => false,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Envoyer',
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'form' => CommPost::class,
        ]);
    }
}
