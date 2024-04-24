<?php

namespace App\Repository;

use App\Entity\ListeFrais;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ListeFrais>
 *
 * @method ListeFrais|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListeFrais|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListeFrais[]    findAll()
 * @method ListeFrais[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListeFraisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListeFrais::class);
    }

    //    /**
    //     * @return ListeFrais[] Returns an array of ListeFrais objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ListeFrais
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
