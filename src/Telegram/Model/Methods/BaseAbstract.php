<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Methods;

abstract class BaseAbstract implements AwareInterface
{
    /** @var string */
    private $token;

    /** @var \App\Telegram\Model\Request\Json\Factory */
    private $jsonRequestFactory;

    // ########################################

    public function setToken(string $token)
    {
        $this->token = $token;
    }

    public function setJsonRequestFactory(\App\Telegram\Model\Request\Json\Factory $jsonRequestFactory)
    {
        $this->jsonRequestFactory = $jsonRequestFactory;
    }

    // ########################################

    /**
     * @return array|bool
     */
    public function send()
    {
        $jsonRequest = $this->jsonRequestFactory->create($this->token);
        $response    = $jsonRequest->execute($this->getMethodName(), $this->getRequestParams());
        if ($response instanceof \App\Telegram\Model\Request\Response\Success) {
            return $response->getData();
        }

        //todo event something goes wrong

        return $response;
    }

    // ########################################

    abstract protected function getMethodName(): string;

    abstract protected function getRequestParams(): array;

    // ########################################
}
