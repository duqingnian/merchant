<?php

namespace App\Repository;

use App\Entity\OrderPayin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderPayin>
 *
 * @method OrderPayin|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderPayin|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderPayin[]    findAll()
 * @method OrderPayin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderPayinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderPayin::class);
    }

//    /**
//     * @return OrderPayin[] Returns an array of OrderPayin objects
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

//    public function findOneBySomeField($value): ?OrderPayin
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
