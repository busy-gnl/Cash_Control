<?php

namespace App\Repository;

use App\Entity\UnexpectedIncomes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UnexpectedIncomes>
 *
 * @method UnexpectedIncomes|null find($id, $lockMode = null, $lockVersion = null)
 * @method UnexpectedIncomes|null findOneBy(array $criteria, array $orderBy = null)
 * @method UnexpectedIncomes[]    findAll()
 * @method UnexpectedIncomes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnexpectedIncomesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnexpectedIncomes::class);
    }

    public function save(UnexpectedIncomes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UnexpectedIncomes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return UnexpectedIncomes[] Returns an array of UnexpectedIncomes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UnexpectedIncomes
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
