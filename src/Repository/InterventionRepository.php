<?php

namespace App\Repository;

use App\Entity\Intervention;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Intervention>
 *
 * @method Intervention|null find($id, $lockMode = null, $lockVersion = null)
 * @method Intervention|null findOneBy(array $criteria, array $orderBy = null)
 * @method Intervention[]    findAll()
 * @method Intervention[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InterventionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Intervention::class);
    }

    public function save(Intervention $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Intervention $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function interventionsWithCity(): array
    {
        $query = $this->createQueryBuilder('i')
            ->addSelect('h', 'l', 'a')
            ->leftJoin('i.horse', 'h')
            ->leftJoin('h.hoster', 'l')
            ->leftJoin('l.adressHoster', 'a')
            ->orderBy('i.startDate', 'ASC')
            ->getQuery();

        return $query->getResult();
    }

    public function interventionsWithCityLimit($value): array
    {
        $query = $this->createQueryBuilder('i')
            ->addSelect('h', 'l', 'a')
            ->leftJoin('i.horse', 'h')
            ->leftJoin('h.hoster', 'l')
            ->leftJoin('l.adressHoster', 'a')
            ->andWhere('i.startDate >= :val')
            ->setParameter('val', $value . '%')
            ->orderBy('i.startDate', 'ASC')
            ->setMaxResults(25)
            ->getQuery();

        return $query->getResult();
    }

    public function interventionsAtDate($value): array
    {
        $query = $this->createQueryBuilder('i')
            ->addSelect('h', 'l', 'a')
            ->leftJoin('i.horse', 'h')
            ->leftJoin('h.hoster', 'l')
            ->leftJoin('l.adressHoster', 'a')
            ->andWhere('i.startDate LIKE :val')
            ->setParameter('val', $value . '%')
            ->orderBy('i.startDate', 'ASC')
            ->getQuery();

        return $query->getResult();
    }

//    /**
//     * @return Intervention[] Returns an array of Intervention objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Intervention
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
