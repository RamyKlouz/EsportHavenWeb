<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepo extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }






    public function findName($value,$order){
        $em = $this->getEntityManager();
        if($order=='DESC') {
            $query = $em->createQuery(
                'SELECT r FROM App\Entity\Produit r   where r.nom like :nomProd order by r.prix DESC '
            );
            $query->setParameter('nomProd', $value . '%');
        }
        else{
            $query = $em->createQuery(
                'SELECT r FROM App\Entity\Produit r   where r.nom like :nomProd order by r.prix ASC '
            );
            $query->setParameter('nomProd', $value . '%');
        }
        return $query->getResult();
    }

















}