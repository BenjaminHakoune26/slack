<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    //Fonction permettant de recuperer tout les messages d'un group
    public function findAllMessagesByGroup($idGroup)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.idGroup = :idGroup')
            ->setParameter('idGroup', $idGroup)
            ->orderBy('m.dateCreate')
            ->getQuery()
            ->getResult()
        ;
    }

    //Fonction permettant d'enregistrer un message en bdd
    public function Ecrire($message)
    {

    }
}
