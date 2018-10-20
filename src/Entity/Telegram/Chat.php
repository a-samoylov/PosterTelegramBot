<?php

namespace App\Entity\Telegram;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Telegram\ChatRepository")
 * @Table(name="telegram_chat")})
 */
class Chat
{
    public const TYPE_PRIVATE    = 'private';
    public const TYPE_GROUP      = 'group';
    public const TYPE_SUPERGROUP = 'supergroup';
    public const TYPE_CHANNEL    = 'channel';

    // ########################################

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false, length=20)
     */
    private $type;

    /**
     * @ORM\Column(type="string")
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     */
    private $lastName;

    // ########################################

    public function setId(int $id): ?self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    // ########################################

    public function isTypePrivate(): bool
    {
        return $this->type == self::TYPE_PRIVATE;
    }

    public function isTypeGroup(): bool
    {
        return $this->type == self::TYPE_GROUP;
    }

    public function isTypeSupergroup(): bool
    {
        return $this->type == self::TYPE_SUPERGROUP;
    }

    public function isTypeChannel(): bool
    {
        return $this->type == self::TYPE_CHANNEL;
    }

    // ----------------------------------------

    public function setTypePrivate(): self
    {
        $this->type = self::TYPE_PRIVATE;

        return $this;
    }

    public function setTypeGroup(): self
    {
        $this->type = self::TYPE_GROUP;

        return $this;
    }

    public function setTypeSupergroup(): self
    {
        $this->type = self::TYPE_SUPERGROUP;

        return $this;
    }

    public function setTypeChannel(): self
    {
        $this->type = self::TYPE_CHANNEL;

        return $this;
    }

    // ########################################

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    // ########################################
}
