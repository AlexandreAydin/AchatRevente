<?php

namespace App\Repository\Annonce\Immobilier;

use App\Entity\Annonce\Immobilier\LandForSale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LandForSale>
 *
 * @method LandForSale|null find($id, $lockMode = null, $lockVersion = null)
 * @method LandForSale|null findOneBy(array $criteria, array $orderBy = null)
 * @method LandForSale[]    findAll()
 * @method LandForSale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LandForSaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LandForSale::class);
    }

    public function save(LandForSale $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LandForSale $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return LandForSale[] Returns an array of LandForSale objects
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

//    public function findOneBySomeField($value): ?LandForSale
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
