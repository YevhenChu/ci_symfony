<?php

declare(strict_types=1);

namespace App\Model;

class PostDetails
{
    private int $id;

    private string $title;

    private string $slug;

    private string $body;

    private int $publishedAt;

    /** @var string[] */
    private array $authors;

    private string $isbn;

    /** @var PostComment[] */
    private array $comments;

    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $id) : self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setTitle(string $title) : self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug() : string
    {
        return $this->slug;
    }

    public function setSlug(string $slug) : self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getBody() : string
    {
        return $this->body;
    }

    public function setBody(string $body) : self
    {
        $this->body = $body;

        return $this;
    }

    public function getPublishedAt() : int
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(int $publishedAt) : self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getAuthors() : array
    {
        return $this->authors;
    }

    /**
     * @param string[] $authors
     *
     * @return $this
     */
    public function setAuthors(array $authors) : self
    {
        $this->authors = $authors;

        return $this;
    }

    /**
     * @return PostComment[]
     */
    public function getComments() : array
    {
        return $this->comments;
    }

    /**
     * @param PostComment[] $comments
     *
     * @return $this
     */
    public function setComments(array $comments) : self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getIsbn() : string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn) : self
    {
        $this->isbn = $isbn;

        return $this;
    }
}
