<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup;

class KeyboardButton
{
    // ########################################

    /**
     * @var string
     */
    private $text;

    /**
     * @var bool
     */
    private $requestContact;

    /**
     * @var bool
     */
    private $requestLocation;

    /**
     * KeyboardButton constructor.
     *
     * @param string $text
     * @param bool   $requestContact
     * @param bool   $requestLocation
     */
    public function __construct(string $text, bool $requestContact, bool $requestLocation)
    {
        $this->text            = $text;
        $this->requestContact  = $requestContact;
        $this->requestLocation = $requestLocation;
    }

    // ########################################

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return bool
     */
    public function isRequestContact(): bool
    {
        return $this->requestContact;
    }

    /**
     * @param bool $requestContact
     */
    public function setRequestContact(bool $requestContact): void
    {
        $this->requestContact = $requestContact;
    }

    /**
     * @return bool
     */
    public function isRequestLocation(): bool
    {
        return $this->requestLocation;
    }

    /**
     * @param bool $requestLocation
     */
    public function setRequestLocation(bool $requestLocation): void
    {
        $this->requestLocation = $requestLocation;
    }

    // ########################################
}
