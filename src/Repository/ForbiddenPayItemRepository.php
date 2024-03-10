<?php

namespace App\Repository;

use App\Entity\ForbiddenPayItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ForbiddenPayItem>
 *
 * @method ForbiddenPayItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForbiddenPayItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForbiddenPayItem[]    findAll()
 * @method ForbiddenPayItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForbiddenPayItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForbiddenPayItem::class);
    }

//    /**
//     * @return ForbiddenPayItem[] Returns an array of ForbiddenPayItem objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ForbiddenPayItem
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
