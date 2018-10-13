<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Methods\Send\Message;

class Factory
{
    /** @var \App\Telegram\Model\Request\Json */
    private $jsonRequest = null;

    // ########################################

    public function __construct(\App\Telegram\Model\Request\Json $jsonRequest)
    {
        $this->jsonRequest = $jsonRequest;
    }

    /**
     * @param string|integer $chatId
     * @param string         $text
     *
     * @return \App\Telegram\Model\Methods\Send\Message
     */
    public function create($chatId, string $text)
    {
        $result = new \App\Telegram\Model\Methods\Send\Message($chatId, $text);
        $result->setJsonRequest($this->jsonRequest);

        return $result;
    }

    // ########################################
}
