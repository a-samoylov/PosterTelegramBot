<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Request;

class Json extends BaseAbstract
{
    // ########################################

    //TODO REFACTORING !!!!!!!!!!!!!!!!!!
    //took from telegram docs

    public function execute($method, array $parameters = [])
    {
        if (!is_string($method)) {
            error_log("Method name must be a string\n");

            return false;
        }

        if (!$parameters) {
            $parameters = [];
        } else {
            if (!is_array($parameters)) {
                error_log("Parameters must be an array\n");

                return false;
            }
        }

        $parameters['method'] = $method;

        $handle = curl_init($this->getApiUrl());
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($handle, CURLOPT_TIMEOUT, 60);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
        curl_setopt($handle, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        return $this->curlRequest->execute($handle);
    }

    // ########################################
}
