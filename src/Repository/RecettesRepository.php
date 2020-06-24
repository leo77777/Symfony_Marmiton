<?php

namespace App\Repository;

use App\Entity\Recettes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recettes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recettes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recettes[]    findAll()
 * @method Recettes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecettesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recettes::class);
    }

    public function getRecetteParPropriete($propriete, $signe, $valeur){
        return $this->createQueryBuilder('a')
        ->andWhere('a.' .$propriete. ' ' .$signe.' :val')
        ->setParameter('val', $valeur)
        ->getQuery()
        ->getResult();
    }

    // //SELECT * FROM `recettes` WHERE nom_recette like '%tarte%'
    // public function getRecetteParPropriete($propriete, $valeur){
    //     return $this->createQueryBuilder('a')
    //     ->andWhere('a.' .$propriete .'=' .':val')
    //     ->setParameter('val', $valeur)
    //     ->getQuery()
    //     ->getResult();
    // }

    public function rechercheRecetteParMotCle($motCle)
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = "SELECT * FROM `recettes` WHERE nom_recette like '%$motCle%' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();      
        //var_dump($stmt->fetchAll());die;
        return $stmt->fetchAll();

    }       




    // /**
    //  * @return Recettes[] Returns an array of Recettes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recettes
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
