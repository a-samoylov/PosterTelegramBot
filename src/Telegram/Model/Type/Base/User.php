<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\Base;

class User
{
    // ########################################

    /**
     * Unique identifier for this user or bot
     *
     * @var int
     */
    private $id;

    /**
     * True, if this user is a bot
     *
     * @var bool
     */
    private $isBot;

    /**
     * User‘s or bot’s first name
     *
     * @var string
     */
    private $firstName;

    /**
     * Optional. User‘s or bot’s last name
     *
     * @var string
     */
    private $lastName;

    /**
     * Optional. User‘s or bot’s username
     *
     * @var string
     */
    private $username;

    /**
     * Optional. IETF language tag of the user's language
     *
     * @var string
     */
    private $languageCode;

    // ########################################

    public function __construct(
        int $id,
        bool $isBot,
        string $firstName
    ) {
        $this->id           = $id;
        $this->isBot        = $isBot;
        $this->firstName    = $firstName;
    }

    // ########################################

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function isBot(): bool
    {
        return $this->isBot;
    }

    /**
     * @param bool $isBot
     */
    public function setIsBot(bool $isBot): void
    {
        $this->isBot = $isBot;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getLanguageCode(): string
    {
        return $this->languageCode;
    }

    /**
     * @param string $languageCode
     */
    public function setLanguageCode(string $languageCode): void
    {
        $this->languageCode = $languageCode;
    }

    // ########################################
}
