<?php

namespace App\Repository;

use App\Entity\MultiPayout;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MultiPayout>
 *
 * @method MultiPayout|null find($id, $lockMode = null, $lockVersion = null)
 * @method MultiPayout|null findOneBy(array $criteria, array $orderBy = null)
 * @method MultiPayout[]    findAll()
 * @method MultiPayout[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MultiPayoutRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MultiPayout::class);
    }

//    /**
//     * @return MultiPayout[] Returns an array of MultiPayout objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MultiPayout
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
