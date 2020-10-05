<?php

namespace App\Repository;

use App\Entity\ServiceSection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ServiceSection|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceSection|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceSection[]    findAll()
 * @method ServiceSection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceSectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiceSection::class);
    }

    // /**
    //  * @return ServiceSection[] Returns an array of ServiceSection objects
    //  */
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
    public function findOneBySomeField($value): ?ServiceSection
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
