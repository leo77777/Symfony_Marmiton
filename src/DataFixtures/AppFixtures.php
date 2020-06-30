<?php

namespace App\DataFixtures;
use \App\Entity\Utilisateur;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i=0; $i <10 ; $i++) { 
            $user = (new Utilisateur())
                    ->setEmail("user$i@gmail.fr")
                    ->setPassword("0000")
                    ->setPseudo("rere")
                    ->setValide(true);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
