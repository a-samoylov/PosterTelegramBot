<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Methods\Send\Invoice;

class Factory
{
    /** @var \App\Telegram\Model\Request\Json\Factory */
    private $jsonRequestFactory;

    // ########################################

    public function __construct(\App\Telegram\Model\Request\Json\Factory $jsonRequestFactory)
    {
        $this->jsonRequestFactory = $jsonRequestFactory;
    }

    /**
     * @param int                                                     $chatId
     * @param \App\Entity\Telegram\Bot                                $bot
     * @param string                                                  $title
     * @param string                                                  $description
     * @param string                                                  $payload
     * @param string                                                  $providerToken
     * @param string                                                  $startParameter
     * @param string                                                  $currency
     * @param \App\Telegram\Model\Methods\Send\Invoice\LabeledPrice[] $prices
     *
     * @return \App\Telegram\Model\Methods\Send\Invoice
     */
    public function create(
        int $chatId,
        \App\Entity\Telegram\Bot $bot,
        string $title,
        string $description,
        string $payload,
        string $providerToken,
        string $startParameter,
        string $currency,
        array $prices
    ): \App\Telegram\Model\Methods\Send\Invoice {
        $result = new \App\Telegram\Model\Methods\Send\Invoice($chatId, $title, $description, $payload, $providerToken, $startParameter,
                                                               $currency, $prices);
        $result->setJsonRequestFactory($this->jsonRequestFactory);
        $result->setToken($bot->getToken());

        return $result;
    }

    // ########################################
}
