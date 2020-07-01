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

    public function assertHasErrors(VerificationCode $code, int $number = 0){
        self::bootKernel();
        $errors = self::$container->get('validator')->validate($code);

        $messages = [];
        foreach ($errors as  $error) {
           $messages[] = $error->getPropertyPath() ."=>" .$error->getMessage();
        }

        $this->assertCount($number, $errors, implode(', ' , $messages));
    }

    public function getEntity() :VerificationCode {
        return (new VerificationCode())
                 ->setCode('12345')
                 ->setDescription('description du test')
                 ->setExpireAt(new \DateTime());
     }
        
    public function testValidEntity(){
        $this->assertHasErrors($this->getEntity(), 0);
    }

    public function testInvalidCodeEntity(){
        $this->assertHasErrors( $this->getEntity()->setCode('1a456'), 1);
    } 

    public function testInvalidCodeBlankEntity(){
        $this->assertHasErrors( $this->getEntity()->setCode(''), 1);
    } 

    public function testInvalidDescriptionEntity(){
        $this->assertHasErrors( $this->getEntity()->setDescription(''), 1);
    } 

    // Ci dessous, test que un code ne soit pas utilisé plusieurs fois
    public function testInvalidUsedTest(){
        $this->loadFixtureFiles([ dirname( __DIR__ ) .'/Fixtures/VerificationCodeFixture.yaml']);
        $this->assertHasErrors($this->getEntity()->setCode('98765'), 1);
    } 
}
