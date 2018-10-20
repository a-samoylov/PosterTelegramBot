<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Bot;

class BotGenerator
{
    /**
     * @var \App\Telegram\Bot\BotGenerator\Settings\Factory
     */
    private $settingsFactory;

    /**
     * @var \App\Repository\Telegram\LayoutRepository
     */
    private $layoutRepository;

    /**
     * @var \App\Repository\Telegram\CallbackMessageRepository
     */
    private $callbackMessageRepository;

    /**
     * @var \App\Repository\Telegram\BotRepository
     */
    private $botRepository;

    // ########################################

    public function __construct(
        \App\Telegram\Bot\BotGenerator\Settings\Factory    $settingsFactory,
        \App\Repository\Telegram\LayoutRepository          $layoutRepository,
        \App\Repository\Telegram\CallbackMessageRepository $callbackMessageRepository,
        \App\Repository\Telegram\BotRepository             $botRepository
    ) {
        $this->settingsFactory           = $settingsFactory;
        $this->layoutRepository          = $layoutRepository;
        $this->callbackMessageRepository = $callbackMessageRepository;
        $this->botRepository             = $botRepository;
    }

    // ########################################

    public function generate(\App\Entity\Telegram\Bot $bot)
    {
        $settings = $this->settingsFactory->create($bot);

        foreach ($settings->getLayouts() as $layout) {
            $this->layoutRepository->create($bot, $layout);
        }

        foreach ($settings->getRelationships() as $relationship) {
            $layout = $this->layoutRepository->findOneBy(['layoutId' => $relationship->getLayoutId()]);
            if (is_null($layout)) {
                throw new \Exception('Not found layout');
            }

            $this->callbackMessageRepository->create(
                $bot,
                $layout,
                $relationship->getButtonId(),
                $relationship->getAction()
            );
        }

        foreach ($settings->getCommands() as $command) {
            $bot->addCommand($command->getName(), $command->getLayoutId());
        }

        $this->botRepository->update($bot);
    }

    // ########################################

    private function clearOldLayouts()
    {
        //todo
    }

    private function clearOldRelationships()
    {
        //todo
    }

    private function clearOldCommands(\App\Entity\Telegram\Bot $bot)
    {
        $bot->removeCommands();
        $this->botRepository->update($bot);
    }

    // ########################################
}
