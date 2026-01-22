<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setNom('Nelson')
            ->setPrenom('Prince')
            ->setEmail('prince@example.com')
            ->setAdresse('123 Music St')
            ->setTel('0102030405')
            ->setBirthDate(new \DateTime('1958-06-07'));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setNom('Jackson')
            ->setPrenom('Michael')
            ->setEmail('michael@example.com')
            ->setAdresse('456 Pop Ave')
            ->setTel('0605040302')
            ->setBirthDate(new \DateTime('1958-08-29'));
        $manager->persist($user2);

        $user3 = new User();
        $user3->setNom('Doe')
            ->setPrenom('Jane')
            ->setEmail('jane@example.com')
            ->setAdresse('789 Test Ave')
            ->setTel('0708091011')
            ->setBirthDate(new \DateTime('1990-01-01'));
        $manager->persist($user3);

        $manager->flush();
    }
}
