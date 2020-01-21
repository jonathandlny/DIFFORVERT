<?php

namespace App\Repository;

use App\Entity\Chaines;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Chaines|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chaines|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chaines[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChainesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chaines::class);
    }

    public function findAll()
    {
        return $this->findBy(array(), array('chaineNumber' => 'ASC'));
    }

    // /**
    //  * @return Chaines[] Returns an array of Chaines objects
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
    public function findOneBySomeField($value): ?Chaines
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
