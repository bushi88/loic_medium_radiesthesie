<?php

namespace App\Repository;

use App\Entity\Zodiaq;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Zodiaq>
 *
 * @method Zodiaq|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zodiaq|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zodiaq[]    findAll()
 * @method Zodiaq[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZodiaqRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Zodiaq::class);
    }

//    /**
//     * @return Zodiaq[] Returns an array of Zodiaq objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('z')
//            ->andWhere('z.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('z.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Zodiaq
//    {
//        return $this->createQueryBuilder('z')
//            ->andWhere('z.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
