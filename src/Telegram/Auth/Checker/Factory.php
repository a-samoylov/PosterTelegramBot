<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Auth\Checker;

use App\Config\Telegram as TelegramConfig;
use App\Telegram\Auth\Checker;

class Factory
{
    /**
     * @var \App\Config\Telegram
     */
    private $telegramConfig;

    // ########################################

    public function __construct(TelegramConfig $telegramConfig)
    {
        $this->telegramConfig = $telegramConfig;
    }

    // ########################################

    public function create(): Checker
    {
        return new Checker($this->telegramConfig->getAuthToken());
    }

    // ########################################
}
