<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Methods\Edit\Message;

class Factory
{
    /** @var \App\Telegram\Model\Request\Json\Factory */
    private $jsonRequestFactory;

    // ########################################

    public function __construct(\App\Telegram\Model\Request\Json\Factory $jsonRequestFactory)
    {
        $this->jsonRequestFactory = $jsonRequestFactory;
    }

    // ########################################

    /**
     * @param int                      $chatId
     * @param \App\Entity\Telegram\Bot $bot
     * @param string|integer           $messageId
     * @param string                   $text
     *
     * @return \App\Telegram\Model\Methods\Edit\Message
     */
    public function create(int $chatId, \App\Entity\Telegram\Bot $bot, int $messageId, string $text)
    {
        $result = new \App\Telegram\Model\Methods\Edit\Message($chatId, $messageId, $text);
        $result->setJsonRequestFactory($this->jsonRequestFactory);
        $result->setToken($bot->getToken());

        return $result;
    }

    // ########################################
}
