<?php

namespace App\Repository\Annonce\Vehicule\Motos;

use App\Entity\Annonce\Vehicule\Motos\MakeOfMoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MakeOfMoto>
 *
 * @method MakeOfMoto|null find($id, $lockMode = null, $lockVersion = null)
 * @method MakeOfMoto|null findOneBy(array $criteria, array $orderBy = null)
 * @method MakeOfMoto[]    findAll()
 * @method MakeOfMoto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MakeOfMotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MakeOfMoto::class);
    }

    public function save(MakeOfMoto $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MakeOfMoto $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MakeOfMoto[] Returns an array of MakeOfMoto objects
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

//    public function findOneBySomeField($value): ?MakeOfMoto
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
