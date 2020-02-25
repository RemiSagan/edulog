<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr');
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user
                ->setName($faker->lastName)
                ->setFirstname($faker->firstName)
                ->setDateOfBirth($faker->dateTimeBetween($startDate = '-18 years', $endDate = '-15 years', $timezone = null))
                ->setCreatedAt(new \DateTime('now'))
                ->setUpdatedAt(new \DateTime('now'));
            $manager->persist($user);
        }

        $manager->flush();
    }
}
