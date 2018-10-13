<?php

namespace App\Entity\Telegram;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Table;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Telegram\SendCallbackMessageRepository")
 * @Table(name="telegram_send_callback_message")})
 */
class SendCallbackMessage
{
    // ########################################

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \App\Entity\Telegram\CallbackMessage
     * @ORM\ManyToOne(targetEntity="App\Entity\Telegram\CallbackMessage")
     * @JoinColumn(name="callback_id", nullable=false, referencedColumnName="id")
     */
    private $callbackMessage;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $answerDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $sendDate;

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
     * @return \App\Entity\Telegram\CallbackMessage
     */
    public function getCallbackMessage(): \App\Entity\Telegram\CallbackMessage
    {
        return $this->callbackMessage;
    }

    /**
     * @param \App\Entity\Telegram\CallbackMessage $callbackMessage
     */
    public function setCallbackMessage(\App\Entity\Telegram\CallbackMessage $callbackMessage): void
    {
        $this->callbackMessage = $callbackMessage;
    }

    // ########################################

    /**
     * @return \DateTime
     */
    public function getAnswerDate(): \DateTime
    {
        return $this->answerDate;
    }

    /**
     * @param \DateTime $answerDate
     */
    public function setAnswerDate(\DateTime $answerDate): void
    {
        $this->answerDate = $answerDate;
    }

    // ########################################

    /**
     * @return \DateTime
     */
    public function getSendDate(): \DateTime
    {
        return $this->sendDate;
    }

    /**
     * @param \DateTime $sendDate
     */
    public function setSendDate(\DateTime $sendDate): void
    {
        $this->sendDate = $sendDate;
    }

    // ########################################
}
