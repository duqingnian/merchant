<?php

namespace App\Repository;

use App\Entity\BankCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BankCode>
 *
 * @method BankCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method BankCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method BankCode[]    findAll()
 * @method BankCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BankCodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BankCode::class);
    }

//    /**
//     * @return BankCode[] Returns an array of BankCode objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BankCode
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
