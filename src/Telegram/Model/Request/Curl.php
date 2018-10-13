<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Request;

class Curl
{

    // ########################################

    //TODO REFACTORING !!!!!!!!!!!!!!!!!!
    //took from telegram docs

    /** @var \App\Telegram\Model\Request\Response\Factory */
    private $responseFactory;

    public function __construct(\App\Telegram\Model\Request\Response\Factory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    // ########################################

    public function execute($handle)
    {
        $response = curl_exec($handle);

        if ($response === false) {
            $errno = curl_errno($handle);
            $error = curl_error($handle);
            error_log("Curl returned error $errno: $error\n");
            curl_close($handle);

            return false;
        }

        $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
        curl_close($handle);

        if ($http_code != 200) {
            $response = json_decode($response, true);
            error_log("Request has failed with error {$response['error_code']}: {$response['description']}\n");
            if ($http_code == 401) {
                throw new \Exception('Invalid access token provided');
            }

            return $this->responseFactory->createFailedResponse((int)$response['error_code'], $response['description']);
        } else {
            $response = json_decode($response, true);
            if (isset($response['description'])) {
                error_log("Request was successful: {$response['description']}\n");
            }
            $response = $response['result'];
        }

        return $this->responseFactory->createSuccessResponse($response);
    }
    // ########################################
}
