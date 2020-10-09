<?php

namespace App\Repository;

use App\Entity\MembreBureau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MembreBureau|null find($id, $lockMode = null, $lockVersion = null)
 * @method MembreBureau|null findOneBy(array $criteria, array $orderBy = null)
 * @method MembreBureau[]    findAll()
 * @method MembreBureau[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MembreBureauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MembreBureau::class);
    }

    // /**
    //  * @return MembreBureau[] Returns an array of MembreBureau objects
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
    public function findOneBySomeField($value): ?MembreBureau
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
