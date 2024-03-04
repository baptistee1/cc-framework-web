<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Lecon;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class AppFixtures extends Fixture
{

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        $eleveInitial = new User();
        $eleveInitial->setNom('Ducobu')
        ->setPrenom('Leleve')
        ->setUsername('EleveInit')
        ->setRoles(['ROLE_ELEVE'])
        ->setPassword(
            $this->userPasswordHasher->hashPassword(
                $eleveInitial,
                'secret'
            )
        );
        $manager->persist($eleveInitial);





        $profInitial = new User();
        $profInitial->setNom('ProfInit Nom')
        ->setPrenom('ProfInit Prenom')
        ->setUsername('ProfInit')
        ->setRoles(['ROLE_ADMIN'])
        ->setPassword(
            $this->userPasswordHasher->hashPassword(
                $profInitial,
                'secret'
            )
        );
        $manager->persist($profInitial);


        $prof2 = new User();
        $prof2->setNom('Prof2 Nom')
        ->setPrenom('Prof2 Prenom')
        ->setUsername('Prof2')
        ->setRoles(['ROLE_PROFESSEUR'])
        ->setPassword(
            $this->userPasswordHasher->hashPassword(
                $prof2,
                'secret'
            )
        );
        $manager->persist($prof2);

        $prof3 = new User();
        $prof3->setNom('Prof3 Nom')
        ->setPrenom('Prof3 Prenom')
        ->setUsername('Prof3')
        ->setRoles(['ROLE_PROFESSEUR'])
        ->setPassword(
            $this->userPasswordHasher->hashPassword(
                $prof3,
                'secret'
            )
        );
        $manager->persist($prof3);


        $faker = \Faker\Factory::create("fr_FR");

        $eleves = [];

        for($i=1;$i<=6;$i++){
            $eleve = new User();
            $eleve->setNom($faker->name)
            ->setPrenom($faker->name)
            ->setUsername('Eleve' . $i)
            ->setRoles(['ROLE_ELEVE'])
            ->setPassword(
                $this->userPasswordHasher->hashPassword(
                    $eleve,
                    'secret'
                )
            );
            $eleves[] = $eleve;
            $manager->persist($eleve);
        }

        for($i=1;$i<=6;$i++){
            $lecon = new Lecon();
            $lecon->setNom($faker->word)
                ->setDescription($faker->sentence)
                ->setCreateur($profInitial) 
                ->addInscrit($eleveInitial) ;

            foreach ($eleves as $eleveInstance) {
                // Faites quelque chose avec l'utilisateur, par exemple, affichez le nom d'utilisateur
                $lecon->addInscrit($eleveInstance);
            }

            $manager->persist($lecon);
        }

        $manager->flush();
    }
}
