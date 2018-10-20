<?php

declare(strict_types=1);

namespace App\Entity\User\Poster;

class Menu
{
    /** @var \App\Entity\User\Poster\Category[] */
    private $categories;

    public function __construct(array $categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return \App\Entity\User\Poster\Category[]
     */
    public function getCategories(): array
    {
        return $this->categories;
    }
}
