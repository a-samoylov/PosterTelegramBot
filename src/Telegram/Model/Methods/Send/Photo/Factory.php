<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Methods\Send\Photo;

class Factory
{
    /** @var \App\Telegram\Model\Request\Json */
    private $jsonRequest = null;

    // ########################################

    public function __construct(\App\Telegram\Model\Request\Json $jsonRequest)
    {
        $this->jsonRequest = $jsonRequest;
    }

    public function create(int $chatId, string $caption, string $url): \App\Telegram\Model\Methods\Send\Photo
    {
        $result = new \App\Telegram\Model\Methods\Send\Photo($chatId, $caption, $url);
        $result->setJsonRequest($this->jsonRequest);

        return $result;
    }

    // ########################################
}
