<?php

namespace App\Repository;

use App\Entity\TeamPlayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

    public function randomId()
    {
        $minMax = $this->createQueryBuilder('t')
            ->select(['min(t.id) as min', 'max(t.id) as max'])
            ->getQuery()
            ->getSingleResult();

        return $this->createQueryBuilder('t')
            ->select(['t.id'])
            ->where('t.id >= :id')
            ->setMaxResults(1)
            ->setParameter('id', rand($minMax['min'], $minMax['max']))
            ->getQuery()
            ->getSingleScalarResult();
    }

/*    public function getById()
    {
        return $this->createQueryBuilder('t')
            ->select(t . id)
            ->addSelect('t.name')
            ->addSelect('t.sport')
            ->from('t')
            ->getQuery()->getSingleResult();
    }*/

}
