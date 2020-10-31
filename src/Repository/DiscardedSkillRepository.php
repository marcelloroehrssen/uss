<?php

namespace App\Repository;

use App\Entity\DiscardedSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DiscardedSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiscardedSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiscardedSkill[]    findAll()
 * @method DiscardedSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiscardedSkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiscardedSkill::class);
    }

    // /**
    //  * @return DiscardedSkill[] Returns an array of DiscardedSkill objects
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
    public function findOneBySomeField($value): ?DiscardedSkill
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
