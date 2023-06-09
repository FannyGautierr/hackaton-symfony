<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher){
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('domain@gmail.com');

        $password = $this->hasher->hashPassword($user, 'password');
        $user->setPassword($password);

        $user->setRoles(['ROLE_SUPER_ADMIN']);

        $manager->persist($user);
        $manager->flush();

        for($i=1;$i<=5;$i++) {
            $user = new User();
            $user->setEmail('station'.$i."@gmail.com");
            $password = $this->hasher->hashPassword($user, 'password');
            $user->setPassword($password);
            $user->setAdminRequest("yes");
            $user->setRoles(['ROLE_ADMIN']);
            $manager->persist($user);
        }
        $manager->flush();
    }
}