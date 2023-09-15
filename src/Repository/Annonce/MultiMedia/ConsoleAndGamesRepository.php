<?php

namespace App\Repository\Annonce\MultiMedia;

use App\Entity\Annonce\MultiMedia\ConsoleAndGames;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConsoleAndGames>
 *
 * @method ConsoleAndGames|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConsoleAndGames|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConsoleAndGames[]    findAll()
 * @method ConsoleAndGames[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsoleAndGamesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConsoleAndGames::class);
    }

    public function save(ConsoleAndGames $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ConsoleAndGames $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ConsoleAndGames[] Returns an array of ConsoleAndGames objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ConsoleAndGames
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
