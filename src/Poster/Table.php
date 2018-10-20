<?php

declare(strict_types=1);

namespace App\Poster;

class Table
{
    /** @var int */
    private $id;

    /** @var int */
    private $num;

    public function __construct(int $id, int $num)
    {
        $this->id  = $id;
        $this->num = $num;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getNum(): int
    {
        return $this->num;
    }
}
