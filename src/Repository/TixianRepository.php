<?php

namespace App\Repository;

use App\Entity\Tixian;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tixian>
 *
 * @method Tixian|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tixian|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tixian[]    findAll()
 * @method Tixian[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TixianRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tixian::class);
    }

//    /**
//     * @return Tixian[] Returns an array of Tixian objects
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

//    public function findOneBySomeField($value): ?Tixian
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
