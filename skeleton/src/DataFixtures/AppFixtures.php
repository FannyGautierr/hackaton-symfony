<?php

namespace App\DataFixtures;

use App\Entity\Domain;
use App\Entity\SkiLift;
use App\Entity\SkiTrack;
use App\Entity\Station;
use App\Entity\User;
use App\Repository\StationRepository;
use Cassandra\Date;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $manager,): void
    {
        $stationsname = ['Les Saisies', 'Crest-Volant Cohennoz', 'Notre-Dame-de-Bellecombe', 'Praz-sur-Arly', 'Flumet'];
        $stationsdesc = ["Une station de ski située dans les Alpes françaises, dans la région de Savoie. Elle est connue pour ses pistes de ski alpin et de ski nordique, ainsi que pour ses vues panoramiques spectaculaires sur les montagnes environnantes, y compris le Mont-Blanc. La station propose également une variété d'activités hivernales et estivales, telles que la raquette, le traîneau à chiens, la luge, le VTT et la randonnée. Les Saisies est une destination populaire pour les familles et les skieurs de tous niveaux grâce à ses pistes adaptées aux débutants ainsi qu'aux skieurs plus expérimentés.", "Située en Haute-Savoie, la station de ski de Crest-Voland Cohennoz est une destination familiale offrant un domaine skiable de plus de 120 km de pistes. Elle se compose de deux villages reliés par une piste de ski de fond, offrant ainsi un cadre authentique et convivial.", "Une petite station de ski située dans les Alpes françaises, dans la région de Savoie. Elle offre un cadre paisible et authentique, idéal pour les skieurs qui cherchent à s'éloigner des foules et à profiter de la nature. La station propose des pistes de ski alpin adaptées aux débutants et aux skieurs intermédiaires, ainsi que des pistes de ski de fond. En été, les visiteurs peuvent profiter de la randonnée et du VTT dans les montagnes environnantes. Le Crest-Volant Cohennoz est une destination de choix pour les familles et les skieurs à la recherche d'une expérience de ski authentique et conviviale.", "Une station de ski conviviale située dans les Alpes françaises, en Haute-Savoie. Elle propose des pistes de ski alpin pour tous les niveaux, ainsi que des pistes de ski de fond et de raquettes à neige. Les visiteurs peuvent également profiter de nombreuses activités en été, comme la randonnée et le VTT, ainsi que de la beauté naturelle de la région.", "Flumet est une petite station de ski située dans les Alpes françaises, en Savoie. Elle offre un domaine skiable idéal pour les débutants et les skieurs intermédiaires, ainsi que des vues imprenables sur le massif du Mont-Blanc. En été, les visiteurs peuvent profiter de nombreuses activités de plein air, notamment la randonnée, le VTT et la pêche.", ];
        $skiliftType = ['Oeufs', 'Tire-fesses', 'Télé-cabine', 'Télé-siège'];
        $skiTrackType = ['Verte', 'Bleue', 'Rouge', 'Noire'];

        $domaine = new Domain();
        $domaine->setName('Domaine des Saisies');
        $domaine->setLogo('skeleton/public/img/logo-domaine.jpeg');
        $manager->persist($domaine);
        $manager->flush();


        for ($i = 1; $i <= 5; $i++){
            $station = new Station();
            if($i == 1){

                $user = new User();
                $user->setEmail('station@gmail.com');

                $password = "password";
                $user->setPassword($this->userPasswordHasher->hashPassword(
                    $user,
                    $password
                ));


                $user->setRoles(['ROLE_ADMIN']);

                $manager->persist($user);
                $manager->flush();

                $station->setUser($user);

            }
            $station->setName($stationsname[$i-1]);
            $station->setDescription($stationsdesc[$i-1]);
            $station->setDomaine($domaine);
            $manager->persist($station);
        }
        $manager->flush();


        $stationRepository = $manager->getRepository(Station::class);
        $stations = $stationRepository->findAll();
        foreach ($stations as $stat){
            for ($i = 1; $i<=10; $i++){
                $skilift = new SkiLift();
                $skilift->setName('Remontée '.$i);
                $date = new \DateTime();
                $skilift->setClose($date);
                $skilift->setOpen($date);
                $skilift->setType($skiliftType[rand(0, 3)]);
                $skilift->setStation($stat);
                $manager->persist($skilift);

                $skitrack = new SkiTrack();
                $skitrack->setName('Piste '.$i);
                $skitrack->setOpen($date);
                $skitrack->setClose($date);
                $skitrack->setDifficulty(($skiTrackType[rand(0,3)]));
                $skitrack->setException(0);
                $skitrack->setStation($stat);
                $manager->persist($skitrack);
            }
        }
        $manager->flush();
    }

}

