<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\Update\MessageUpdate;

class Factory implements \App\Telegram\Model\Type\FactoryInterface
{
    // ########################################

    /**
     * @var \App\Telegram\Model\Type\Base\Message\Factory
     */
    private $messageFactory;

    // ########################################

    public function __construct(\App\Telegram\Model\Type\Base\Message\Factory $messageFactory)
    {
        $this->messageFactory = $messageFactory;
    }

    // ########################################

    public function create(array $data): \App\Telegram\Model\Type\Update\MessageUpdate
    {
        if (empty($data['update_id']) && is_int($data['update_id'])) {
            throw new \App\Model\Exception\Validate(self::class, 'update_id');
        }

        return new \App\Telegram\Model\Type\Update\MessageUpdate(
            $data['update_id'],
            $this->messageFactory->create($data['message'])
        );
    }

    // ########################################
}
