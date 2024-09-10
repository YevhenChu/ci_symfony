<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Entity\Comment;
use App\Model\CommentListItem;

class CommentMapper
{
    public static function map(Comment $comment, CommentListItem $commentListItem) : CommentListItem
    {
        return $commentListItem
            ->setTitle($comment->getTitle())
            ->setAuthor($comment->getAuthor())
            ->setContent($comment->getContent())
            ->setCreatedAt($comment->getCreatedAt()->getTimestamp());
    }
}
