<?php

namespace App\Repository;

use App\Entity\SkillDot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SkillDot|null find($id, $lockMode = null, $lockVersion = null)
 * @method SkillDot|null findOneBy(array $criteria, array $orderBy = null)
 * @method SkillDot[]    findAll()
 * @method SkillDot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkillDotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SkillDot::class);
    }

    // /**
    //  * @return SkillDot[] Returns an array of SkillDot objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SkillDot
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
