<?php

namespace App\Repository;

use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Team|null find($id, $lockMode = null, $lockVersion = null)
 * @method Team|null findOneBy(array $criteria, array $orderBy = null)
 * @method Team[]    findAll()
 * @method Team[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Team::class);
    }

     /**
      * @return Team[] Returns an array of Team objects
      */
    public function getTeamList()
    {
        return $this->createQueryBuilder('t')
            ->select('t.name, t.logoURI')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getPlayerListBasedOnTeam($id)
    {
        return $this->createQueryBuilder('t')
            ->select('p.firstName,p.lastName, p.playerImageUri')
            ->leftJoin('t.teamPlayer','tp')
            ->leftJoin('tp.player', 'p')
            ->Where('t.id = :id')
            ->orWhere('t.name = :name')
            ->setParameter('id', $id)
            ->setParameter('name', $id)
            ->getQuery()
            ->getArrayResult();
        ;
    }
}
