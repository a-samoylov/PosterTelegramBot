<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Request\Response;

class Failed
{
    /**
     * @var int
     */
    private $errorCode;

    /**
     * @var string
     */
    private $description;

    // ########################################

    public function __construct(int $errorCode, string $description = null)
    {
        $this->errorCode   = $errorCode;
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    // ########################################
}
