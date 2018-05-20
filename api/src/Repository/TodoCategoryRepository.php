<?php

namespace App\Repository;

use App\Entity\TodoCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TodoCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method TodoCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method TodoCategory[]    findAll()
 * @method TodoCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TodoCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TodoCategory::class);
    }

//    /**
//     * @return TodoCategory[] Returns an array of TodoCategory objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TodoCategory
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
