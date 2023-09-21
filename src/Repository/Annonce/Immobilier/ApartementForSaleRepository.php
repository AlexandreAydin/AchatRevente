<?php

namespace App\Repository\Annonce\Immobilier;

use App\Entity\Annonce\Immobilier\ApartementForSale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApartementForSale>
 *
 * @method ApartementForSale|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApartementForSale|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApartementForSale[]    findAll()
 * @method ApartementForSale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApartementForSaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApartementForSale::class);
    }

    public function save(ApartementForSale $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ApartementForSale $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ApartementForSale[] Returns an array of ApartementForSale objects
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

//    public function findOneBySomeField($value): ?ApartementForSale
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
