<?php

namespace App\Repository;

use App\Entity\OperationMinus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OperationMinus|null find($id, $lockMode = null, $lockVersion = null)
 * @method OperationMinus|null findOneBy(array $criteria, array $orderBy = null)
 * @method OperationMinus[]    findAll()
 * @method OperationMinus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationMinusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OperationMinus::class);
    }

//    /**
//     * @return OperationMinus[] Returns an array of OperationMinus objects
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
    public function findOneBySomeField($value): ?OperationMinus
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
