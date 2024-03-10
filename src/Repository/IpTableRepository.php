<?php

namespace App\Repository;

use App\Entity\IpTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IpTable>
 *
 * @method IpTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method IpTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method IpTable[]    findAll()
 * @method IpTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IpTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IpTable::class);
    }

//    /**
//     * @return IpTable[] Returns an array of IpTable objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?IpTable
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
