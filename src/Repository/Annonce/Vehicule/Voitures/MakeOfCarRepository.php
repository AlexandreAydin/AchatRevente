<?php

namespace App\Repository\Annonce\Vehicule\Voitures;

use App\Entity\Annonce\Vehicule\Voitures\MakeOfCar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MakeOfCar>
 *
 * @method MakeOfCar|null find($id, $lockMode = null, $lockVersion = null)
 * @method MakeOfCar|null findOneBy(array $criteria, array $orderBy = null)
 * @method MakeOfCar[]    findAll()
 * @method MakeOfCar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MakeOfCarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MakeOfCar::class);
    }

    public function save(MakeOfCar $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MakeOfCar $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MakeOfCar[] Returns an array of MakeOfCar objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MakeOfCar
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
