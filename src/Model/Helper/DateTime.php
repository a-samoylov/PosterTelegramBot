<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Model\Helper;

class DateTime
{
    // ########################################

    public function getCurrentDateTime(): \DateTime
    {
        return new \DateTime('now', new \DateTimeZone('UTC'));
    }

    public function create(int $timestamp): \DateTime
    {
        return new \DateTime('@' . $timestamp, new \DateTimeZone('UTC'));
    }

    // ########################################
}
