<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @return Article[] Returns an array of Article objects
     */
    public function findLatestPublished(): array
    {

        return $this->published($this->lastest())
            ->leftJoin('a.comments', 'c')
            ->addSelect('c')
            ->leftJoin('a.tags', 't')
            ->addSelect('t')
            ->getQuery()
            ->getResult();
    }

    public function findLatest(): array
    {
        return $this->lastest()
            ->getQuery()
            ->getResult();
    }

    public function findPublished(): array
    {
        return $this->published()
            ->getQuery()
            ->getResult();
    }

    private function published(QueryBuilder $qb = null): QueryBuilder
    {
        return $this->getOrCreateQueryBuilder($qb)->orderBy(' a.publishedAt','DESC');
    }

    private function lastest(QueryBuilder $qb = null): QueryBuilder
    {
        return $this->getOrCreateQueryBuilder($qb)->andWhere(' a.publishedAt IS NOT NULL');
    }

    /**
     * @param QueryBuilder|null $qb
     * @return QueryBuilder|null
     */
    public function getOrCreateQueryBuilder(?QueryBuilder $qb): ?QueryBuilder
    {
        return $qb ?? $this->createQueryBuilder('a');
    }
}
