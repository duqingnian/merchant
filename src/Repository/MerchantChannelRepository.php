<?php

namespace App\Repository;

use App\Entity\MerchantChannel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MerchantChannel>
 *
 * @method MerchantChannel|null find($id, $lockMode = null, $lockVersion = null)
 * @method MerchantChannel|null findOneBy(array $criteria, array $orderBy = null)
 * @method MerchantChannel[]    findAll()
 * @method MerchantChannel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MerchantChannelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MerchantChannel::class);
    }

//    /**
//     * @return MerchantChannel[] Returns an array of MerchantChannel objects
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

//    public function findOneBySomeField($value): ?MerchantChannel
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
