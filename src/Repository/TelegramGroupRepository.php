<?php

namespace App\Repository;

use App\Entity\TelegramGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TelegramGroup>
 *
 * @method TelegramGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method TelegramGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method TelegramGroup[]    findAll()
 * @method TelegramGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TelegramGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TelegramGroup::class);
    }

//    /**
//     * @return TelegramGroup[] Returns an array of TelegramGroup objects
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

//    public function findOneBySomeField($value): ?TelegramGroup
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
