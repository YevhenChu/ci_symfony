<?php

declare(strict_types=1);

namespace App\Model;

class CommentListResponse
{
    /**
     * @param CommentListItem[] $items
     */
    public function __construct(private readonly array $items)
    {
    }

    /**
     * @return CommentListItem[]
     */
    public function getItems() : array
    {
        return $this->items;
    }
}
