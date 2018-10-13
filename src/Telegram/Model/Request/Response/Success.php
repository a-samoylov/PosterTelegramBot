<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Request\Response;

class Success
{
    /**
     * @var array
     */
    private $data;

    // ########################################

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    // ########################################

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    // ########################################
}
