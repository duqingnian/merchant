<?php

namespace App\Repository;

use App\Entity\TelegramBotVoucher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TelegramBotVoucher>
 *
 * @method TelegramBotVoucher|null find($id, $lockMode = null, $lockVersion = null)
 * @method TelegramBotVoucher|null findOneBy(array $criteria, array $orderBy = null)
 * @method TelegramBotVoucher[]    findAll()
 * @method TelegramBotVoucher[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TelegramBotVoucherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TelegramBotVoucher::class);
    }

//    /**
//     * @return TelegramBotVoucher[] Returns an array of TelegramBotVoucher objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TelegramBotVoucher
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
