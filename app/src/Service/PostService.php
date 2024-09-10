<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Post;
use App\Entity\Comment;
use App\Model\PostComment;
use App\Model\PostDetails;
use App\Repository\PostRepository;
use App\Mapper\PublishedPostMapper;
use App\Model\PublishedPostListItem;
use App\Model\PublishedPostListResponse;

class PostService
{
    public function __construct(
        private readonly PostRepository $postRepository,
    ) {
    }

    public function getPublishedPosts() : PublishedPostListResponse
    {
        return new PublishedPostListResponse(array_map(
            fn (Post $post) : PublishedPostListItem|PostDetails => PublishedPostMapper::map($post, new PublishedPostListItem()),
            $this->postRepository->getPublishedPosts()
        ));
    }

    public function getPostById(int $id) : PostDetails
    {
        $post = $this->postRepository->getPostById($id);

        $comments = $post->getComments()
            ->map(fn (Comment $comment) : PostComment => new PostComment(
                $comment->getId(),
                $comment->getTitle(),
                $comment->getContent(),
                $comment->getCreatedAt()->getTimestamp(),
                $comment->getAuthor()
            ));

        return PublishedPostMapper::map($post, new PostDetails())
            ->setComments($comments->toArray());
    }
}
