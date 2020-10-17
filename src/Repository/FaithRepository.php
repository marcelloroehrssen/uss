<?php

namespace App\Repository;

use App\Entity\Faith;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Faith|null find($id, $lockMode = null, $lockVersion = null)
 * @method Faith|null findOneBy(array $criteria, array $orderBy = null)
 * @method Faith[]    findAll()
 * @method Faith[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FaithRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Faith::class);
    }

    // /**
    //  * @return Faith[] Returns an array of Faith objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Faith
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
