<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Methods\Send\Message;

class Factory
{
    /** @var \App\Telegram\Model\Request\Json\Factory */
    private $jsonRequestFactory;

    // ########################################

    public function __construct(\App\Telegram\Model\Request\Json\Factory $jsonRequestFactory)
    {
        $this->jsonRequestFactory = $jsonRequestFactory;
    }

    /**
     * @param \App\Entity\Telegram\User $user
     * @param \App\Entity\Telegram\Bot  $bot
     * @param string                    $text
     *
     * @return \App\Telegram\Model\Methods\Send\Message
     */
    public function create(\App\Entity\Telegram\User $user, \App\Entity\Telegram\Bot $bot, string $text)
    {
        $result = new \App\Telegram\Model\Methods\Send\Message($user->getChat()->getId(), $text);
        $result->setJsonRequestFactory($this->jsonRequestFactory);
        $result->setToken($bot->getToken());

        return $result;
    }

    // ########################################
}
