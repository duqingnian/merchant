<?php

namespace App\Repository;

use App\Entity\OrderPayout;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderPayout>
 *
 * @method OrderPayout|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderPayout|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderPayout[]    findAll()
 * @method OrderPayout[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderPayoutRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderPayout::class);
    }

//    /**
//     * @return OrderPayout[] Returns an array of OrderPayout objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OrderPayout
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
