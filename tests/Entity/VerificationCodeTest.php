<?php

namespace App\Tests\Entity;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\VerificationCode;
use Liip\TestFixturesBundle\Test\FixturesTrait;


// On étends une classe Kernel car on va avoir besoin de l entité
//  et d éléments comme le Repository, ...  qui font partie du noyau 
class VerificationCodeTest  extends KernelTestCase
{
    use FixturesTrait;
    
    public function getEntity() :VerificationCode {
       return (new VerificationCode())
                ->setCode('12345')
                ->setDescription('description du test')
                ->setExpireAt(new \DateTime());
    }
    
    public function testValidEntity(){
        $code = $this->getEntity();
        self::bootKernel();
        $errors = self::$container->get('validator')->validate($code);
        $this->assertCount(0, $errors);
    }

    public function testInvalidCodeEntity(){
        $code = $this->getEntity()->setCode('1a456');
        self::bootKernel();
        $errors = self::$container->get('validator')->validate($code);
        $this->assertCount(1, $errors);
    } 

    public function testInvalidCodeBlankEntity(){
        $code = $this->getEntity()->setCode('');
        self::bootKernel();
        $errors = self::$container->get('validator')->validate($code);
        $this->assertCount(1, $errors);
    } 

    public function testInvalidDescriptionEntity(){
        $code = $this->getEntity()->setDescription('');
        self::bootKernel();
        $errors = self::$container->get('validator')->validate($code);
        $this->assertCount(1, $errors);
    } 

    // Ci dessous, test que un code ne soit pas utilisé plusieurs fois
    public function testInvalidUsedTest(){
        $this->loadFixtureFiles([ dirname( __DIR__ ) .'/Fixtures/VerificationCodeFixture.yaml']);
        $code = $this->getEntity()->setCode('98765');
        self::bootKernel();
        $errors = self::$container->get('validator')->validate($code);
        $this->assertCount(1, $errors);
    } 
}
