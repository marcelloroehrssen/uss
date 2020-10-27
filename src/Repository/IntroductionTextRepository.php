<?php

namespace App\Repository;

use App\Entity\IntroductionText;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IntroductionText|null find($id, $lockMode = null, $lockVersion = null)
 * @method IntroductionText|null findOneBy(array $criteria, array $orderBy = null)
 * @method IntroductionText[]    findAll()
 * @method IntroductionText[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IntroductionTextRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IntroductionText::class);
    }

    // /**
    //  * @return IntroductionText[] Returns an array of IntroductionText objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IntroductionText
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
