<?php

declare(strict_types=1);

namespace App\Entity\User\Poster;

class Category
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var self[] */
    private $subCategories;

    /** @var \App\Entity\User\Poster\Product[] */
    private $products;

    public function __construct(int $id, string $name, array $subCategories, array $products)
    {
        $this->id            = $id;
        $this->name          = $name;
        $this->subCategories = $subCategories;
        $this->products      = $products;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return \App\Entity\User\Poster\Category[]
     */
    public function getSubCategories(): array
    {
        return $this->subCategories;
    }

    /**
     * @return \App\Entity\User\Poster\Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }
}
