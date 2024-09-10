<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Comment;
use App\Mapper\CommentMapper;
use App\Model\CommentListItem;
use App\Model\CommentListResponse;
use App\Repository\CommentRepository;

class CommentService
{
    public function __construct(private readonly CommentRepository $commentRepository)
    {
    }

    public function getCommentByPostId(int $id) : CommentListResponse
    {
        return new CommentListResponse(array_map(
            fn (Comment $comment) : CommentListItem => CommentMapper::map($comment, new CommentListItem()),
            $this->commentRepository->getCommentByPostId($id)
        ));
    }
}
