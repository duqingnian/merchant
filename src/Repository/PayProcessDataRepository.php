<?php

namespace App\Repository;

use App\Entity\PayProcessData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PayProcessData>
 *
 * @method PayProcessData|null find($id, $lockMode = null, $lockVersion = null)
 * @method PayProcessData|null findOneBy(array $criteria, array $orderBy = null)
 * @method PayProcessData[]    findAll()
 * @method PayProcessData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PayProcessDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PayProcessData::class);
    }

//    /**
//     * @return PayProcessData[] Returns an array of PayProcessData objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PayProcessData
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
