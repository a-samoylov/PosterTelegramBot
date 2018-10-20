<?php

declare(strict_types=1);

namespace App\Entity\User\Poster;

class Product
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var int */
    private $price;

    /** @var string */
    private $photo;

    public function __construct(int $id, string $name, int $price, string $photo)
    {
        $this->id    = $id;
        $this->name  = $name;
        $this->price = $price;
        $this->photo = $photo;
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
     * @return string
     */
    public function getPhoto(): string
    {
        return $this->photo;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }
}
