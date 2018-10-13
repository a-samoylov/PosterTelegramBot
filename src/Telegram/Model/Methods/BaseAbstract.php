<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Methods;

abstract class BaseAbstract implements AwareInterface
{
    /** @var \App\Telegram\Model\Request\Json */
    private $jsonRequest = null;

    // ########################################

    public function setJsonRequest(\App\Telegram\Model\Request\Json $jsonRequest)
    {
        $this->jsonRequest = $jsonRequest;
    }

    // ########################################

    /**
     * @return array|bool
     */
    public function send()
    {
        $response = $this->jsonRequest->execute($this->getMethodName(), $this->getRequestParams());
        if ($response instanceof \App\Telegram\Model\Request\Response\Success) {
            return $response->getData();
        }

        //todo event something goes wrong

        return false;
    }

    // ########################################

    abstract protected function getMethodName(): string;

    abstract protected function getRequestParams(): array;

    // ########################################
}
