<?php

namespace App\Repository;

use App\Entity\Magasin;
use App\Entity\Produit;
use App\Entity\ProduitsMagasins;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProduitsMagasins|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitsMagasins|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitsMagasins[]    findAll()
 * @method ProduitsMagasins[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitsMagasinsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProduitsMagasins::class);
    }

    // /**
    //  * @return ProduitsMagasins[] Returns an array of ProduitsMagasins objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProduitsMagasins
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
