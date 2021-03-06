<?php

namespace App\Repository;

use App\Entity\Expirience;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Expirience|null find($id, $lockMode = null, $lockVersion = null)
 * @method Expirience|null findOneBy(array $criteria, array $orderBy = null)
 * @method Expirience[]    findAll()
 * @method Expirience[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpirienceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Expirience::class);
    }

//    /**
//     * @return Expirience[] Returns an array of Expirience objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Expirience
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
