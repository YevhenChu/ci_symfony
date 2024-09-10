<?php

declare(strict_types=1);

namespace App\Repository;

use DateTime;
use App\Entity\Post;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Post>
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Post::class);
    }

    /**
     * @return array<Post>
     */
    public function getPublishedPosts() : array
    {
        return $this->createQueryBuilder('p')
            ->where('p.published_at IS NOT NULL')
            ->where('p.published_at <= :now')
            ->setParameter('now', new DateTime())
            ->getQuery()
            ->getResult();
    }

    public function getPostById(int $id) : Post
    {
        return $this->createQueryBuilder('p')
            ->where('p.id = :id')
            ->andWhere('p.published_at IS NOT NULL')
            ->andWhere('p.published_at <= :now')
            ->setParameter('id', $id)
            ->setParameter('now', new DateTime())
            ->getQuery()
            ->getOneOrNullResult();
    }
}
