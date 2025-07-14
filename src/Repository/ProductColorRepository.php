<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\ProductColor;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<ProductColor>
 *
 * @method ProductColor|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductColor|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductColor[]    findAll()
 * @method ProductColor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductColorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductColor::class);
    }

    public function add(ProductColor $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProductColor $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByRefColor(string $ref, Product $product):array
    {
        return $this->createQueryBuilder('p')
        ->join('p.color', 'b')
        ->andWhere('b.refColor = :color')
        ->setParameter('color', $ref)
        ->andWhere('p.product = :product')
        ->setParameter('product', $product)
        ->getQuery()
        ->getResult();

    }

    // /**
    //  * fonction permet de recuperer la liste des produits colorer grouper par produit
    //  *
    //  * @return array
    //  */
    // public function findGroupByProduct(): array
    // {
    //     return $this->createQueryBuilder('p')
    //     ->groupBy('p.product')
    //     ->orderBy('p.id', 'DESC')
    //     ->getQuery()
    //     ->getResult();}

    //    /**
    //     * @return ProductColor[] Returns an array of ProductColor objects
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

    //    public function findOneBySomeField($value): ?ProductColor
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
