<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Auth;

class Checker
{
    private $accessToken = null;

    // ########################################

    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    // ########################################

    public function isValidToken($token)
    {
        return $this->accessToken == $token;
    }

    // ########################################
}
