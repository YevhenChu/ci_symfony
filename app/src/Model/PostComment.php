<?php

declare(strict_types=1);

namespace App\Model;

class PostComment
{
    public function __construct(
        private readonly int $id,
        private readonly string $title,
        private readonly string $content,
        private readonly int $createdAt,
        private readonly string $author,
    ) {
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getContent() : string
    {
        return $this->content;
    }

    public function getCreatedAt() : int
    {
        return $this->createdAt;
    }

    public function getAuthor() : string
    {
        return $this->author;
    }
}
