<?php

namespace App\Repository;

use App\Entity\TeamPlayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TeamPlayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method TeamPlayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method TeamPlayer[]    findAll()
 * @method TeamPlayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamPlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TeamPlayer::class);
    }

    // /**
    //  * @return TeamPlayer[] Returns an array of TeamPlayer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TeamPlayer
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
