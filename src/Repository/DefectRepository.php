<?php

namespace App\Repository;

use App\Entity\Defect;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Defect|null find($id, $lockMode = null, $lockVersion = null)
 * @method Defect|null findOneBy(array $criteria, array $orderBy = null)
 * @method Defect[]    findAll()
 * @method Defect[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DefectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Defect::class);
    }

    // /**
    //  * @return Defect[] Returns an array of Defect objects
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
    public function findOneBySomeField($value): ?Defect
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
