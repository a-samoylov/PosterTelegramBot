<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass="\App\Repository\UserRepository")
 */
class User
{
    // ########################################

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $login;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    private $posterAccount;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    private $posterAccessKey;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private $posterMenu;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    private $posterSpotId;

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

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getPosterAccount(): ?string
    {
        return $this->posterAccount;
    }

    /**
     * @param string|null $posterAccount
     */
    public function setPosterAccount(?string $posterAccount): void
    {
        $this->posterAccount = $posterAccount;
    }

    /**
     * @return string|null
     */
    public function getPosterAccessKey(): ?string
    {
        return $this->posterAccessKey;
    }

    /**
     * @param string|null $posterAccessKey
     */
    public function setPosterAccessKey(?string $posterAccessKey): void
    {
        $this->posterAccessKey = $posterAccessKey;
    }

    public function getPosterMenu(): \App\Entity\User\Poster\Menu
    {
        return unserialize($this->posterMenu);
    }

    public function setPosterMenu(\App\Entity\User\Poster\Menu $posterMenu): void
    {
        $this->posterMenu = serialize($posterMenu);
    }

    /**
     * @return int
     */
    public function getPosterSpotId(): int
    {
        return $this->posterSpotId;
    }

    /**
     * @param int $posterSpotId
     */
    public function setPosterSpotId(int $posterSpotId): void
    {
        $this->posterSpotId = $posterSpotId;
    }
}
