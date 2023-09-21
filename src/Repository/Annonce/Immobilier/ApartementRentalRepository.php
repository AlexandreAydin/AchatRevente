<?php

namespace App\Repository\Annonce\Immobilier;

use App\Entity\Annonce\Immobilier\ApartementRental;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApartementRental>
 *
 * @method ApartementRental|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApartementRental|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApartementRental[]    findAll()
 * @method ApartementRental[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApartementRentalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApartementRental::class);
    }

    public function save(ApartementRental $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ApartementRental $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ApartementRental[] Returns an array of ApartementRental objects
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

//    public function findOneBySomeField($value): ?ApartementRental
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
