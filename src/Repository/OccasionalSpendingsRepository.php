<?php

namespace App\Repository;

use App\Entity\OccasionalSpendings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OccasionalSpendings>
 *
 * @method OccasionalSpendings|null find($id, $lockMode = null, $lockVersion = null)
 * @method OccasionalSpendings|null findOneBy(array $criteria, array $orderBy = null)
 * @method OccasionalSpendings[]    findAll()
 * @method OccasionalSpendings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OccasionalSpendingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OccasionalSpendings::class);
    }

    public function save(OccasionalSpendings $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OccasionalSpendings $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return OccasionalSpendings[] Returns an array of OccasionalSpendings objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OccasionalSpendings
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
