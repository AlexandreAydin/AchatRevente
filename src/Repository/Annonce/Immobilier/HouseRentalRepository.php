<?php

namespace App\Repository\Annonce\Immobilier;

use App\Entity\Annonce\Immobilier\HouseRental;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HouseRental>
 *
 * @method HouseRental|null find($id, $lockMode = null, $lockVersion = null)
 * @method HouseRental|null findOneBy(array $criteria, array $orderBy = null)
 * @method HouseRental[]    findAll()
 * @method HouseRental[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HouseRentalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HouseRental::class);
    }

    public function save(HouseRental $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(HouseRental $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return HouseRental[] Returns an array of HouseRental objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HouseRental
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
