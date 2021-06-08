<?php

namespace App\Repository;

use App\Entity\Campers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Campers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Campers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Campers[]    findAll()
 * @method Campers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Campers::class);
    }

    // /**
    //  * @return Campers[] Returns an array of Campers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Campers
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
