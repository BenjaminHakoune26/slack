<?php

namespace App\Repository;

use App\Entity\Group;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use http\Message;

/**
 * @method Group|null find($id, $lockMode = null, $lockVersion = null)
 * @method Group|null findOneBy(array $criteria, array $orderBy = null)
 * @method Group[]    findAll()
 * @method Group[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Group::class);
    }

    // /**
    //  * @return Group[] Returns an array of Group objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    //Fonction permettant de recuperer les groupes
    public function findAllGroups()
    {
        return $this->createQueryBuilder('g')
            ->getQuery()
            ->getArrayResult()
        ;
    }

    //Fonction permettant de trouver les groupes d'un utilisateur
    public function findGroupByMessage($idMember)
    {
        return $this->createQueryBuilder('g')
            ->from('App\Entity\Message', 'm')
            ->where('m.idGroup = g.id')
            ->andWhere('m.idMember = :idMember')
            ->setParameter('idMember', $idMember)
            ->getQuery()
            ->getArrayResult()
            ;
    }

}
