<?php

namespace App\Repository;

use App\Entity\CvMain;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CvMain|null find($id, $lockMode = null, $lockVersion = null)
 * @method CvMain|null findOneBy(array $criteria, array $orderBy = null)
 * @method CvMain[]    findAll()
 * @method CvMain[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CvMainRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CvMain::class);
    }

//    /**
//     * @return CvMain[] Returns an array of CvMain objects
//     */
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
    public function findOneBySomeField($value): ?CvMain
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
