<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command;

class Response
{
    /**
     * @var bool
     */
    private $isSuccess;

    /**
     * @var string
     */
    private $message;

    // ########################################

    public function __construct(bool $isSuccess, string $message)
    {
        $this->isSuccess = $isSuccess;
        $this->message   = $message;
    }

    // ########################################

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    // ########################################
}
