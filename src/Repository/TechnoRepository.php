<?php

namespace App\Repository;

use App\Entity\Techno;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Techno>
 *
 * @method Techno|null find($id, $lockMode = null, $lockVersion = null)
 * @method Techno|null findOneBy(array $criteria, array $orderBy = null)
 * @method Techno[]    findAll()
 * @method Techno[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TechnoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Techno::class);
    }

    public function add(Techno $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Techno $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Techno[] Returns an array of Techno objects
     */
    public function findByFrontTechno(): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.frontBack = :val')
            ->setParameter('val', 'front')
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByBackTechno(): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.frontBack = :val')
            ->setParameter('val', 'back')
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

//    public function findOneBySomeField($value): ?Techno
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
