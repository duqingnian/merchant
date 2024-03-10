<?php

namespace App\Repository;

use App\Entity\TelegramBotCmd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TelegramBotCmd>
 *
 * @method TelegramBotCmd|null find($id, $lockMode = null, $lockVersion = null)
 * @method TelegramBotCmd|null findOneBy(array $criteria, array $orderBy = null)
 * @method TelegramBotCmd[]    findAll()
 * @method TelegramBotCmd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TelegramBotCmdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TelegramBotCmd::class);
    }

//    /**
//     * @return TelegramBotCmd[] Returns an array of TelegramBotCmd objects
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

//    public function findOneBySomeField($value): ?TelegramBotCmd
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
