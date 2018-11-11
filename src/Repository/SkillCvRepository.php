<?php

namespace App\Repository;

use App\Entity\SkillCv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SkillCv|null find($id, $lockMode = null, $lockVersion = null)
 * @method SkillCv|null findOneBy(array $criteria, array $orderBy = null)
 * @method SkillCv[]    findAll()
 * @method SkillCv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkillCvRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SkillCv::class);
    }

//    /**
//     * @return SkillCv[] Returns an array of SkillCv objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SkillCv
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
