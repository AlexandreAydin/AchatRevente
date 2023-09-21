<?php

namespace App\Repository\Annonce\Immobilier;

use App\Entity\Annonce\Immobilier\HouseForSale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HouseForSale>
 *
 * @method HouseForSale|null find($id, $lockMode = null, $lockVersion = null)
 * @method HouseForSale|null findOneBy(array $criteria, array $orderBy = null)
 * @method HouseForSale[]    findAll()
 * @method HouseForSale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HouseForSaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HouseForSale::class);
    }

    public function save(HouseForSale $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(HouseForSale $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return HouseForSale[] Returns an array of HouseForSale objects
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

//    public function findOneBySomeField($value): ?HouseForSale
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
