<?php

namespace App\Repository;

use App\Entity\MembrePret;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MembrePret|null find($id, $lockMode = null, $lockVersion = null)
 * @method MembrePret|null findOneBy(array $criteria, array $orderBy = null)
 * @method MembrePret[]    findAll()
 * @method MembrePret[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MembrePretRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MembrePret::class);
    }

    public function findOneByUsername($value): ?MembrePret
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.username = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    // /**
    //  * @return MembrePret[] Returns an array of MembrePret objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MembrePret
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
