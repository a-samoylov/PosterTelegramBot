<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 01.10.2018
 * Time: 21:57
 */

namespace App\Telegram\Model\Methods;

interface AwareInterface
{
    // ########################################

    public function setToken(string $token);

    public function setJsonRequestFactory(\App\Telegram\Model\Request\Json\Factory $jsonRequestFactory);

    // ########################################
}
