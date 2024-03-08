<?php

namespace App\Repository;

use App\Entity\TelegramBotQuery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TelegramBotQuery>
 *
 * @method TelegramBotQuery|null find($id, $lockMode = null, $lockVersion = null)
 * @method TelegramBotQuery|null findOneBy(array $criteria, array $orderBy = null)
 * @method TelegramBotQuery[]    findAll()
 * @method TelegramBotQuery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TelegramBotQueryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TelegramBotQuery::class);
    }

//    /**
//     * @return TelegramBotQuery[] Returns an array of TelegramBotQuery objects
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

//    public function findOneBySomeField($value): ?TelegramBotQuery
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
