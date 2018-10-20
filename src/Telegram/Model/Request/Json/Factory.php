<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Request\Json;

class Factory
{
    /**
     * @var \App\Telegram\Model\Request\Curl
     */
    private $curl;

    // ########################################

    public function __construct(\App\Telegram\Model\Request\Curl $curl)
    {
        $this->curl = $curl;
    }

    // ########################################

    public function create(string $token): \App\Telegram\Model\Request\Json
    {
        return new \App\Telegram\Model\Request\Json($token, $this->curl);
    }

    // ########################################
}
