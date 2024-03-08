<?php

namespace App\Repository;

use App\Entity\MultiPayoutOrders;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MultiPayoutOrders>
 *
 * @method MultiPayoutOrders|null find($id, $lockMode = null, $lockVersion = null)
 * @method MultiPayoutOrders|null findOneBy(array $criteria, array $orderBy = null)
 * @method MultiPayoutOrders[]    findAll()
 * @method MultiPayoutOrders[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MultiPayoutOrdersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MultiPayoutOrders::class);
    }

//    /**
//     * @return MultiPayoutOrders[] Returns an array of MultiPayoutOrders objects
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

//    public function findOneBySomeField($value): ?MultiPayoutOrders
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
