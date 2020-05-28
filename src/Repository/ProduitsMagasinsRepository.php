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

    public function shortStock($nb)
    {
        return $this->createQueryBuilder('pm')
            ->innerJoin('pm.produit', 'p')
            ->where('pm.stockQte <= :val')
            ->andWhere('p.actif = :actif')
            ->setParameter('val', $nb)
            ->setParameter('actif', true)
            ->getQuery()
            ->getResult();
    }
}
