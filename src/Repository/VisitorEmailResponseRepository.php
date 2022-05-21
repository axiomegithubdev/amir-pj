<?php

namespace App\Repository;

use App\Entity\VisitorEmailResponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VisitorEmailResponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method VisitorEmailResponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method VisitorEmailResponse[]    findAll()
 * @method VisitorEmailResponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisitorEmailResponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VisitorEmailResponse::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(VisitorEmailResponse $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(VisitorEmailResponse $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return VisitorEmailResponse[] Returns an array of VisitorEmailResponse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VisitorEmailResponse
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
