<?php

namespace App\Entity\Telegram;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Telegram\BotRepository")
 * @Table(name="telegram_bot")})
 */
class Bot
{
    // ########################################

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $token;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $accessKey;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $settings;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $commands;

    // ########################################

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // ########################################

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    // ########################################

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    // ########################################

    /**
     * @return string
     */
    public function getAccessKey(): string
    {
        return $this->accessKey;
    }

    /**
     * @param string $accessKey
     */
    public function setAccessKey(string $accessKey): void
    {
        $this->accessKey = $accessKey;
    }

    // ########################################

    /**
     * @return array
     */
    public function getSettings(): array
    {
        return (array)json_decode($this->settings, true);
    }

    /**
     * @param array $settings
     */
    public function setSettings(array $settings): void
    {
        $this->settings = (array)json_encode($settings);
    }

    /**
     * @return array
     */
    public function getCommands()
    {
        return (array)json_encode($this->commands);
    }

    /**
     * @param string $name
     * @param int    $layoutId
     */
    public function addCommand(string $name, int $layoutId): void
    {
        $commands = (array)json_decode($this->commands);
        $commands[$name] = $layoutId;
        $this->commands = json_encode($commands);
    }

    public function removeCommand(string $name)
    {
        $commands = (array)json_decode($this->commands);
        unset($commands[$name]);
        $this->commands = json_encode($commands);
    }

    // ########################################
}
