<?php

namespace App\Repository;

use App\Entity\ChannelPayMethod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ChannelPayMethod>
 *
 * @method ChannelPayMethod|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChannelPayMethod|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChannelPayMethod[]    findAll()
 * @method ChannelPayMethod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChannelPayMethodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChannelPayMethod::class);
    }

//    /**
//     * @return ChannelPayMethod[] Returns an array of ChannelPayMethod objects
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

//    public function findOneBySomeField($value): ?ChannelPayMethod
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
