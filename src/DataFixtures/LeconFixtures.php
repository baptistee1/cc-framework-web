<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Lecon;

class LeconFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $faker = \Faker\Factory::create("fr_FR");
        // for($i=1;$i<=6;$i++){
        //     $lecon = new Lecon();
        //     $lecon->setNom($faker->word)
        //         ->setDescription($faker->sentence);
        //     $manager->persist($lecon);
        // }

        // $manager->flush();
    }
}
