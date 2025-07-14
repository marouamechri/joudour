<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function add(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function FindProductType(string $type, string $genre): array
    {
        $query = $this->createQueryBuilder('p')
            ->join('p.typeProduct', 'b')
            ->andWhere('b.nameOption = :type')
            ->setParameter('type', $type)
            ->andWhere('p.genre= :genre')
            ->setParameter('genre', $genre)
            ->andWhere('p.active= :active')
            ->setParameter('active', true)
            ->andWhere('p.action= :action')
            ->setParameter('action', 'Vente');
        return $query->getQuery()->getResult();
    }
    public function FindAllActive(): array
    {
        $query = $this->createQueryBuilder('p')
            ->andWhere('p.active= :active')
            ->setParameter('active', true);
        return $query->getQuery()->getResult();
    }

    public function FindNewCollection(): array
    {
        $query = $this->createQueryBuilder('p')
            ->andWhere('p.newColletion= :new')
            ->setParameter('new', true);
        return $query->getQuery()->getResult();
    }
    public function findNewCollectionlimit(int $first): array
    {
        $query = $this->createQueryBuilder('p')
           ->setFirstResult($first)
           ->setMaxResults(3)
            ->andWhere('p.newColletion= :new')
            ->setParameter('new', true);
        return $query->getQuery()->getResult();
    }

    // public function orderPrices(String $order):array
    // {
    //     $query = $this->createQueryBuilder('b');

    //     if($order == 'DESC')
    //     {
    //         $query->select('b')
    //             ->orderBy('b.amountHTVA', $order) ;
    //         $order = 'ASC';
    //     }
    //     else{
    //         $query->select('b')
    //         ->orderBy('b.amountHTVA', $order) ;
    //         $order = 'DESC';
    //     }

    //     return $query->getQuery()->getResult();

    // }

    //    /**
    //     * @return Product[] Returns an array of Product objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Product
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
