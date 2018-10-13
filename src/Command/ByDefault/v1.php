<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command\ByDefault;

class v1 extends \App\Command\BaseAbstract
{
    // ########################################

    /**
     * @return bool|string
     */
    public function validate()
    {
        return true;
    }

    // ########################################

    public function processCommand(): void
    {
        //todo is not register
    }

    // ########################################
}
