<?php

namespace App\Repository;

use App\Entity\ProductUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductUser[]    findAll()
 * @method ProductUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductUser::class);
    }

    // /**
    //  * @return ProductUser[] Returns an array of ProductUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductUser
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
