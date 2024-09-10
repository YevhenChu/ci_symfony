<?php

declare(strict_types=1);

namespace App\Model;

class CommentListItem
{
    private string $title;

    private string $content;

    private string $author;

    private int $createdAt;

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setTitle(string $title) : self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent() : string
    {
        return $this->content;
    }

    public function setContent(string $content) : self
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor() : string
    {
        return $this->author;
    }

    public function setAuthor(string $author) : self
    {
        $this->author = $author;

        return $this;
    }

    public function getCreatedAt() : int
    {
        return $this->createdAt;
    }

    public function setCreatedAt(int $createdAt) : self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
