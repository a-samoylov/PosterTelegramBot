<?php

declare(strict_types=1);

namespace App\Poster;

class Config
{
    /** @var int */
    private $applicationId;

    /** @var string */
    private $applicationSecret;

    /** @var string */
    private $redirectUrl;

    public function __construct(int $applicationId, string $applicationSecret, string $redirectUrl)
    {
        $this->applicationId     = $applicationId;
        $this->applicationSecret = $applicationSecret;
        $this->redirectUrl       = $redirectUrl;
    }

    /**
     * @return int
     */
    public function getApplicationId(): int
    {
        return $this->applicationId;
    }

    /**
     * @return string
     */
    public function getApplicationSecret(): string
    {
        return $this->applicationSecret;
    }

    /**
     * @return string
     */
    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }

}
