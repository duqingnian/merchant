<?php

namespace App\Repository;

use App\Entity\ChannelColumnMap;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ChannelColumnMap>
 *
 * @method ChannelColumnMap|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChannelColumnMap|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChannelColumnMap[]    findAll()
 * @method ChannelColumnMap[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChannelColumnMapRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChannelColumnMap::class);
    }

//    /**
//     * @return ChannelColumnMap[] Returns an array of ChannelColumnMap objects
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

//    public function findOneBySomeField($value): ?ChannelColumnMap
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
