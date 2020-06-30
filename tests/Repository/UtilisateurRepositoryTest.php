<?php

namespace App\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Repository\UtilisateurRepository;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use App\DataFixtures\AppFixtures;

class UtilisateurRepositoryTest  extends KernelTestCase
{
    use FixturesTrait ;
    
    public function testCount(){
        $kernel = self::bootKernel();
       //   $this->loadFixtures( [AppFixtures::class] );

       $users = $this->loadFixtureFiles( [
           __DIR__ ."/UtilisateurRepositoryFixture.yaml"
       ] );

        // $users['user1']['email']; <= Voila ce qu'il est possible de faire

        // $kernel->getContainer(); // getContainer : permet de récuperer tous les services inclus dans Symfony
        //                           // Renvoit tout un container ! 

        // self::$container; // idem a getContainer() mais permet de recuperer des choses en plus
        //                  // comme des constantes et des variables . Meilleure syntaxe !  
        
        // get() : pour récuperer 1 élément du container!
        $users = self::$container->get(UtilisateurRepository::class)->count([]); // il va récuperer le fichier 'UtilisateurRepository.php'
        $this->assertEquals(10, $users);   
    }
}
