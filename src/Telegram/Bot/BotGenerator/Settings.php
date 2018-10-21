<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Bot\BotGenerator;

class Settings
{
    public const TYPE_REPLY_INLINE_KEYBOARD_MARKUP = 'inline_keyboard_markup';
    public const TYPE_REPLY_KEYBOARD_MARKUP        = 'keyboard_markup';

    /** @var \App\Entity\Telegram\Bot */
    private $bot;

    /** @var \App\Telegram\Bot\BotGenerator\Settings\Layout[] */
    private $layouts;

    /** @var \App\Telegram\Bot\BotGenerator\Settings\RelationshipInline[] */
    private $relationshipsInline;

    /** @var \App\Telegram\Bot\BotGenerator\Settings\RelationshipKeyboard[] */
    private $relationshipsKeyboard;

    /** @var \App\Telegram\Bot\BotGenerator\Settings\Command[] */
    private $commands;

    // ########################################

    /**
     * @param \App\Entity\Telegram\Bot $bot
     */
    public function __construct(\App\Entity\Telegram\Bot $bot)
    {
        $this->bot = $bot;
    }

    // ########################################

    /**
     * @return \App\Telegram\Bot\BotGenerator\Settings\Layout[]
     */
    public function getLayouts(): array
    {
        return $this->layouts;
    }

    /**
     * @param \App\Telegram\Bot\BotGenerator\Settings\Layout $layout
     */
    public function addLayout(\App\Telegram\Bot\BotGenerator\Settings\Layout $layout): void
    {
        $this->layouts[] = $layout;
    }

    // ########################################

    /**
     * @param \App\Telegram\Bot\BotGenerator\Settings\RelationshipInline $relationship
     */
    public function addRelationshipInline(\App\Telegram\Bot\BotGenerator\Settings\RelationshipInline $relationship): void
    {
        $this->relationshipsInline[] = $relationship;
    }

    /**
     * @return \App\Telegram\Bot\BotGenerator\Settings\RelationshipInline[]
     */
    public function getRelationshipsInline(): array
    {
        return $this->relationshipsInline;
    }

    public function addRelationshipKeyboard(\App\Telegram\Bot\BotGenerator\Settings\RelationshipKeyboard $relationship): void
    {
        $this->relationshipsKeyboard[] = $relationship;
    }

    /**
     * @return \App\Telegram\Bot\BotGenerator\Settings\RelationshipKeyboard[]
     */
    public function getRelationshipsKeyboard(): array
    {
        return $this->relationshipsKeyboard;
    }

    // ########################################

    /**
     * @return \App\Telegram\Bot\BotGenerator\Settings\Command[]
     */
    public function getCommands(): array
    {
        return $this->commands;
    }

    /**
     * @param \App\Telegram\Bot\BotGenerator\Settings\Command $command
     */
    public function addCommand(\App\Telegram\Bot\BotGenerator\Settings\Command $command): void
    {
        $this->commands[] = $command;
    }

    // ########################################
}
