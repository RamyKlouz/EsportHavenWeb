<?php

namespace App\Repository;

use App\Entity\Sponsors;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sponsors|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sponsors|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sponsors[]    findAll()
 * @method Sponsors[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SponsorRepo extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sponsors::class);
    }






    public function findUser($valueemail,$order){
        $em = $this->getEntityManager();
        if($order=='DESC') {
            $query = $em->createQuery(
                'SELECT r FROM App\Entity\Sponsors r   where r.nomSponsor like :nomSponsorr order by r.idSponsor DESC '
            );
            $query->setParameter('nomSponsorr', $valueemail . '%');
        }
        else{
            $query = $em->createQuery(
                'SELECT r FROM App\Entity\Sponsors r   where r.nomSponsor like :nomSponsorr  order by r.idSponsor ASC '
            );
            $query->setParameter('nomSponsorr', $valueemail . '%');
        }
        return $query->getResult();
    }





    public function find_Nb_Rec_Par_Status($type){

        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT DISTINCT  count(r.idSponsor) FROM   App\Entity\Sponsors r  where r.typeSponsor = :typeSponsor   '
        );
        $query->setParameter('typeSponsor', $type);
        return $query->getResult();
    }












}