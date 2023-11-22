<?php

namespace App\Repository\Annonce;

use App\Entity\Annonce\Article;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function save(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function paginationQuery()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ;
    }



    public function findWithSearch($search)
    {
        // $query = $this->createQueryBuilder('a')
        // ->orderBy('a.id', 'DESC');

        $categorieVehiculesId = 1; // Remplacez par la bonne valeur

        $query = $this->createQueryBuilder('a')
        ->leftJoin('a.categorie', 'c') // Jointure sur 'categorie'
        ->leftJoin('a.voitures', 'v') // Jointure sur 'voitures'
        ->leftJoin('a.camions', 'cam')// Jointure sur 'camions'
        ->where('c.id = :categorieId')
        ->setParameter('categorieId', $categorieVehiculesId)
        ->addSelect('a.title', 'a.price', 'v.mileage') // Sélection des champs nécessaires
        ->orderBy('a.id', 'DESC');
    
        // Conditions de prix
        if ($search->getMinPrice()) {
            $query = $query->andWhere('a.price >= :minPrice')
                ->setParameter('minPrice', $search->getMinPrice());
        }
        
        if ($search->getMaxPrice()) {
            $query = $query->andWhere('a.price <= :maxPrice')
                ->setParameter('maxPrice', $search->getMaxPrice());
        }
        
        // Conditions de kilométrage
        if ($search->getMinMileage()) {
            $query = $query->andWhere('v.mileage >= :minMileage OR cam.mileage >= :minMileage')
                ->setParameter('minMileage', $search->getMinMileage());
        }
        
        if ($search->getMaxMileage()) {
            $query = $query->andWhere('v.mileage <= :maxMileage OR cam.mileage <= :maxMileage')
                ->setParameter('maxMileage', $search->getMaxMileage());
        }
        
        // Filtrage par catégories si nécessaire
        if ($search->getCategories()) {
            $query = $query->andWhere('c.id IN (:categories)')
                ->setParameter('categories', $search->getCategories());
        }
        
        return $query->getQuery()->getResult();
    
    }


//    /**
//     * @return Article[] Returns an array of Article objects
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

//    public function findOneBySomeField($value): ?Article
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
