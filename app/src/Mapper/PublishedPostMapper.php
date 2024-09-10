<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Entity\Post;
use App\Model\PostDetails;
use App\Model\PublishedPostListItem;

class PublishedPostMapper
{
    public static function map(
        Post $post,
        PublishedPostListItem|PostDetails $model,
    ) : PublishedPostListItem|PostDetails {
        return $model
            ->setTitle($post->getTitle())
            ->setSlug($post->getSlug())
            ->setBody($post->getBody())
            ->setPublishedAt($post->getPublishedAt()->getTimestamp())
            ->setAuthors($post->getAuthors())
            ->setIsbn($post->getIsbn());
    }
}
