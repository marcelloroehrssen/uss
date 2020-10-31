<?php

namespace App\Repository;

use App\Entity\CharacterBackground;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CharacterBackground|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharacterBackground|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharacterBackground[]    findAll()
 * @method CharacterBackground[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterBackgroundRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CharacterBackground::class);
    }

    // /**
    //  * @return CharacterBackground[] Returns an array of CharacterBackground objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CharacterBackground
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
