<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;

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
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $phone;

    /**
     * @var \App\Entity\Telegram\Chat
     * @ORM\OneToOne(targetEntity="App\Entity\Telegram\Chat")
     * @JoinColumn(name="id", nullable=false, referencedColumnName="id")
     */
    private $chat;

    /**
     * @var \App\Entity\Bot
     * @ORM\OneToOne(targetEntity="App\Entity\Bot")
     * @JoinColumn(name="id", nullable=false, referencedColumnName="id")
     */
    private $bot;

    /**
     * @ORM\Column(type="int", nullable=false)
     */
    private $currentLayout;

    // ########################################

    public function __construct()
    {
    }

    // ########################################



    // ########################################
}
