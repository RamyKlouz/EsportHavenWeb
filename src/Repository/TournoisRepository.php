<?php

namespace App\Repository;

use App\Entity\Tournois;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method Tournois|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tournois|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tournois[]    findAll()
 * @method Tournois[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TournoisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tournois::class);
    }


    public function findTournoisByNom($nom){
        return $this->createQueryBuilder('tournois')
            ->where('tournois.nom LIKE :nom')
            ->setParameter('nom', '%'.$nom.'%')
            ->getQuery()
            ->getResult();
    }




}
