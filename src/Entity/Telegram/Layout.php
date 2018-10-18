<?php

namespace App\Entity\Telegram;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Telegram\LayoutRepository")
 */
class Layout
{
    // ########################################

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=1000, nullable=false)
     */
    private $text;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $replyMarkup;


    // ########################################

    public function getId(): ?int
    {
        return $this->id;
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
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    // ########################################

    /**
     * @return mixed
     */
    public function getReplyMarkup()
    {
        return $this->replyMarkup;
    }

    /**
     * @param mixed $replyMarkup
     */
    public function setReplyMarkup($replyMarkup): void
    {
        $this->replyMarkup = $replyMarkup;
    }

    // ########################################
}