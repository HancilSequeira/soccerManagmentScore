<?php

namespace App\Repository;

use App\Entity\Players;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Players|null find($id, $lockMode = null, $lockVersion = null)
 * @method Players|null findOneBy(array $criteria, array $orderBy = null)
 * @method Players[]    findAll()
 * @method Players[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Players::class);
    }


    public function findByFirstNameAndLastName($firstName, $lastName)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.firstName = :firstName')
            ->andWhere('p.lastName = :lastName')
            ->setParameter('firstName', $firstName)
            ->setParameter('lastName', $lastName)
            ->getQuery()
            ->getOneOrNullResult();
        ;
    }



    public function deletePlayerById($playerId)
    {
        return $this->createQueryBuilder('p')
            ->delete()
            ->andWhere('p.id = :id')
            ->setParameter('id', $playerId)
            ->getQuery()
            ->execute()
        ;
    }

}
