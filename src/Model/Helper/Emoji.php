<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Model\Helper;

/** https://apps.timwhitlock.info/emoji/tables/unicode */
class Emoji
{
    // ########################################

    //Dingbats
    private const GREEN_CHECK = 'E29C85'; //white heavy check mark

    // ########################################

    public function getGreenCheck()
    {
        return hex2bin(self::GREEN_CHECK);
    }
    // ########################################
}
