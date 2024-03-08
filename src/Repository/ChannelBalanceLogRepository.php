<?php

namespace App\Repository;

use App\Entity\ChannelBalanceLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ChannelBalanceLog>
 *
 * @method ChannelBalanceLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChannelBalanceLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChannelBalanceLog[]    findAll()
 * @method ChannelBalanceLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChannelBalanceLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChannelBalanceLog::class);
    }

//    /**
//     * @return ChannelBalanceLog[] Returns an array of ChannelBalanceLog objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ChannelBalanceLog
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
