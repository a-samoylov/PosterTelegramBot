<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\Update\CallbackQuery\CallbackData;

class Factory implements \App\Telegram\Model\Type\FactoryInterface
{
    // ########################################

    public function create(array $data): \App\Telegram\Model\Type\Update\CallbackQuery\CallbackData
    {
        if (empty($data['id']) && is_int($data['id'])) {
            throw new \App\Model\Exception\Validate(self::class, 'id');
        }

        if (empty($data['btn']) && is_int($data['btn'])) {
            throw new \App\Model\Exception\Validate(self::class, 'btn');
        }

        return new \App\Telegram\Model\Type\Update\CallbackQuery\CallbackData($data['id'], $data['btn']);
    }

    // ########################################
}
