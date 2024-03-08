<?php

namespace App\Repository;

use App\Entity\ChannelPaymentMethodSetting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ChannelPaymentMethodSetting>
 *
 * @method ChannelPaymentMethodSetting|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChannelPaymentMethodSetting|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChannelPaymentMethodSetting[]    findAll()
 * @method ChannelPaymentMethodSetting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChannelPaymentMethodSettingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChannelPaymentMethodSetting::class);
    }

//    /**
//     * @return ChannelPaymentMethodSetting[] Returns an array of ChannelPaymentMethodSetting objects
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

//    public function findOneBySomeField($value): ?ChannelPaymentMethodSetting
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
