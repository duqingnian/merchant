<?php

namespace App\Repository;

use App\Entity\MerchantNotifyLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MerchantNotifyLog>
 *
 * @method MerchantNotifyLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method MerchantNotifyLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method MerchantNotifyLog[]    findAll()
 * @method MerchantNotifyLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MerchantNotifyLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MerchantNotifyLog::class);
    }

//    /**
//     * @return MerchantNotifyLog[] Returns an array of MerchantNotifyLog objects
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

//    public function findOneBySomeField($value): ?MerchantNotifyLog
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
