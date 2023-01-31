<?php

namespace App\Repository;

use App\Entity\MonthlyExpenses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MonthlyExpenses>
 *
 * @method MonthlyExpenses|null find($id, $lockMode = null, $lockVersion = null)
 * @method MonthlyExpenses|null findOneBy(array $criteria, array $orderBy = null)
 * @method MonthlyExpenses[]    findAll()
 * @method MonthlyExpenses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonthlyExpensesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MonthlyExpenses::class);
    }

    public function save(MonthlyExpenses $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MonthlyExpenses $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MonthlyExpenses[] Returns an array of MonthlyExpenses objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MonthlyExpenses
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
