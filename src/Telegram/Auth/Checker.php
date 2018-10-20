<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Auth;

class Checker
{

    /**
     * @var \App\Repository\Telegram\BotRepository
     */
    private $botRepository;

    // ########################################

    public function __construct(\App\Repository\Telegram\BotRepository $botRepository)
    {
        $this->botRepository = $botRepository;
    }

    // ########################################

    public function isValidAccessKey($accessKey)
    {
        $bot = $this->botRepository->findOneBy(['accessKey' => $accessKey]);
        return !is_null($bot);
    }

    // ########################################
}
