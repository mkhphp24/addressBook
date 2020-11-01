<?php

namespace App\Repository;

use App\Entity\AddressBooks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AddressBooks|null find($id, $lockMode = null, $lockVersion = null)
 * @method AddressBooks|null findOneBy(array $criteria, array $orderBy = null)
 * @method AddressBooks[]    findAll()
 * @method AddressBooks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddressBooksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AddressBooks::class);
    }

    // /**
    //  * @return AddressBooks[] Returns an array of AddressBooks objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AddressBooks
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
