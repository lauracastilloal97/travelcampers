<?php

namespace App\Repository;

use App\Entity\Rute;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rute|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rute|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rute[]    findAll()
 * @method Rute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RuteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rute::class);
    }

    // /**
    //  * @return Rute[] Returns an array of Rute objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rute
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
