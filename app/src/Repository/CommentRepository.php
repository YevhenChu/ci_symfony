<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Comment>
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Comment::class);
    }

    /**
     * @return array<Comment>
     */
    public function getCommentByPostId(int $id) : array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.post = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}
