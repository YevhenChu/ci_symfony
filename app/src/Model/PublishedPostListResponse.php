<?php

declare(strict_types=1);

namespace App\Model;

class PublishedPostListResponse
{
    /**
     * @param PublishedPostListItem[] $items
     */
    public function __construct(private readonly array $items)
    {
    }

    /**
     * @return PublishedPostListItem[]
     */
    public function getItems() : array
    {
        return $this->items;
    }
}
