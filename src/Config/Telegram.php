<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Config;

class Telegram
{
    /** @var array */
    private $configs;

    // ########################################

    public function __construct(YamlLoader $loader)
    {
        $this->configs = $loader->load('services/telegram.yaml');
    }

    // ########################################

    public function getAuthToken(): ?string
    {
        return isset($this->configs['parameters']['auth_token']) ? $this->configs['parameters']['auth_token'] : null;
    }

    public function getApiUrl(): ?string
    {
        return isset($this->configs['parameters']['api_url']) ? $this->configs['parameters']['api_url'] : null;
    }
    // ########################################

    public function getMessageServiceName(string $text): ?string
    {
        if (empty($this->configs['commands']['message'])) {
            return null;
        }

        /**
         * @var array $messages
         */
        $messageCommands = $this->configs['commands']['message'];
        foreach ($messageCommands as $serviceName => $serviceData) {
            if ($serviceData['text'] == $text) {
                return $serviceName;
            }
        }

        return null;
    }

    // ----------------------------------------

    public function getCallbackQueryServiceName(string $alias): ?string
    {
        if (empty($this->configs['commands']['callbackquery'])) {
            return null;
        }

        /**
         * @var array $callbackQueryCommands
         */
        $callbackQueryCommands = $this->configs['commands']['callbackquery'];
        foreach ($callbackQueryCommands as $serviceName => $serviceData) {
            if ($serviceData['alias'] == $alias) {
                return $serviceName;
            }
        }

        return null;
    }

    // ########################################
}
