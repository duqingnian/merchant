<?php

namespace App\Repository;

use App\Entity\ChannelStatusCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ChannelStatusCode>
 *
 * @method ChannelStatusCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChannelStatusCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChannelStatusCode[]    findAll()
 * @method ChannelStatusCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChannelStatusCodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChannelStatusCode::class);
    }

//    /**
//     * @return ChannelStatusCode[] Returns an array of ChannelStatusCode objects
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

//    public function findOneBySomeField($value): ?ChannelStatusCode
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
