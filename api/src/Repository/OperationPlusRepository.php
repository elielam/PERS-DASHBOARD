<?php

namespace App\Repository;

use App\Entity\OperationPlus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OperationPlus|null find($id, $lockMode = null, $lockVersion = null)
 * @method OperationPlus|null findOneBy(array $criteria, array $orderBy = null)
 * @method OperationPlus[]    findAll()
 * @method OperationPlus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationPlusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OperationPlus::class);
    }

//    /**
//     * @return OperationPlus[] Returns an array of OperationPlus objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OperationPlus
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
