<?php

namespace App\Repository;

use App\Entity\MembreAssistanceSociale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MembreAssistanceSociale|null find($id, $lockMode = null, $lockVersion = null)
 * @method MembreAssistanceSociale|null findOneBy(array $criteria, array $orderBy = null)
 * @method MembreAssistanceSociale[]    findAll()
 * @method MembreAssistanceSociale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MembreAssistanceSocialeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MembreAssistanceSociale::class);
    }

    // /**
    //  * @return MembreAssistanceSociale[] Returns an array of MembreAssistanceSociale objects
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
    public function findOneBySomeField($value): ?MembreAssistanceSociale
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
