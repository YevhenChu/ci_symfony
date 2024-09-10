<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $body = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?DateTimeImmutable $published_at = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    /**
     * @var string[]|null
     */
    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $authors = null;

    #[ORM\Column(length: 13, nullable: true)]
    private ?string $isbn = null;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'post', orphanRemoval: true)]
    private Collection $comments;

    public function getId() : ?int
    {
        return $this->id;
    }

    public function getTitle() : ?string
    {
        return $this->title;
    }

    public function setTitle(string $title) : static
    {
        $this->title = $title;

        return $this;
    }

    public function getBody() : ?string
    {
        return $this->body;
    }

    public function setBody(?string $body) : static
    {
        $this->body = $body;

        return $this;
    }

    public function getPublishedAt() : ?DateTimeImmutable
    {
        return $this->published_at;
    }

    public function setPublishedAt(?DateTimeImmutable $published_at) : static
    {
        $this->published_at = $published_at;

        return $this;
    }

    public function getSlug() : ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug) : static
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getAuthors() : ?array
    {
        return $this->authors;
    }

    /**
     * @param string[]|null $authors
     *
     * @return $this
     */
    public function setAuthors(?array $authors) : static
    {
        $this->authors = $authors;

        return $this;
    }

    public function getIsbn() : ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn) : static
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments() : Collection
    {
        return $this->comments;
    }

    /**
     * @param Collection<int, Comment> $comments
     *
     * @return $this
     */
    public function setComments(Collection $comments) : self
    {
        $this->comments = $comments;

        return $this;
    }
}
