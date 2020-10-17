<?php

namespace App\Repository;

use App\Entity\Dot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dot[]    findAll()
 * @method Dot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dot::class);
    }

    // /**
    //  * @return Dot[] Returns an array of Dot objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dot
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
