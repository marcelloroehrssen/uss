<?php

namespace App\Repository;

use App\Entity\DowntimeDefinition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DowntimeDefinition|null find($id, $lockMode = null, $lockVersion = null)
 * @method DowntimeDefinition|null findOneBy(array $criteria, array $orderBy = null)
 * @method DowntimeDefinition[]    findAll()
 * @method DowntimeDefinition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DowntimeDefinitionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DowntimeDefinition::class);
    }

    // /**
    //  * @return DowntimeDefinition[] Returns an array of DowntimeDefinition objects
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
    public function findOneBySomeField($value): ?DowntimeDefinition
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
