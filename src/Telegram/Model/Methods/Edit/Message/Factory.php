<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Methods\Edit\Message;

class Factory
{
    /** @var \App\Telegram\Model\Request\Json */
    private $jsonRequest = null;

    // ########################################

    public function __construct(\App\Telegram\Model\Request\Json $jsonRequest)
    {
        $this->jsonRequest = $jsonRequest;
    }

    // ########################################

    /**
     * @param int            $chatId
     * @param string|integer $messageId
     * @param string         $text
     *
     * @return \App\Telegram\Model\Methods\Edit\Message
     */
    public function create(int $chatId, int $messageId, string $text)
    {
        $result = new \App\Telegram\Model\Methods\Edit\Message($chatId, $messageId, $text);
        $result->setJsonRequest($this->jsonRequest);

        return $result;
    }

    // ########################################
}
