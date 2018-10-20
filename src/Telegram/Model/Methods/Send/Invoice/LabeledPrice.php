<?php

declare(strict_types=1);

namespace App\Telegram\Model\Methods\Send\Invoice;

class LabeledPrice
{
    private $label;

    private $amount;

    public function __construct(string $label, int $amount)
    {
        $this->label  = $label;
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }
}
