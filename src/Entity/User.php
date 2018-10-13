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
    private const INTENSITY_SMALL  = 1;
    private const INTENSITY_MEDIUM = 2;
    private const INTENSITY_LARGE  = 3;

    private const REGISTER_STEP_FINISH    = 1;
    private const REGISTER_STEP_START     = 2;
    private const REGISTER_STEP_SUBJECT   = 3;
    private const REGISTER_STEP_INTENSITY = 4;

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
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $intensity;

    /**
     * @var \App\Entity\Subject[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Subject")
     * @JoinTable(name="users_subjects",
     *      joinColumns={@JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="subject_id", referencedColumnName="id")}
     *      )
     */
    private $subjects;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $registerStep;

    // ########################################

    public function __construct()
    {
        $this->subjects = new ArrayCollection();
    }

    // ########################################

    public function getId(): ?int
    {
        return $this->id;
    }

    // ########################################

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    // ########################################

    public function getIntensity(): ?int
    {
        return $this->intensity;
    }

    public function setIntensity(int $intensity): self
    {
        $this->intensity = $intensity;

        return $this;
    }

    public function hasIntensity(): bool
    {
        return is_null($this->intensity);
    }

    // ########################################

    public function isRegister(): bool
    {
        return $this->registerStep == self::REGISTER_STEP_FINISH;
    }

    public function isRegisterStartStep(): bool
    {
        return $this->registerStep == self::REGISTER_STEP_START;
    }

    public function isRegisterSubjectStep(): bool
    {
        return $this->registerStep == self::REGISTER_STEP_SUBJECT;
    }

    public function isRegisterIntensityStep(): bool
    {
        return $this->registerStep == self::REGISTER_STEP_INTENSITY;
    }

    // ----------------------------------------

    public function setRegisterStartStep(): self
    {
        $this->registerStep = self::REGISTER_STEP_START;

        return $this;
    }

    public function setRegisterSubjectStep(): self
    {
        $this->registerStep = self::REGISTER_STEP_SUBJECT;

        return $this;
    }

    public function setRegisterIntensityStep(): self
    {
        $this->registerStep = self::REGISTER_STEP_INTENSITY;

        return $this;
    }

    public function setRegister(): self
    {
        $this->registerStep = self::REGISTER_STEP_FINISH;

        return $this;
    }

    // ########################################

    public function getChat(): Telegram\Chat
    {
        return $this->chat;
    }

    public function setChat(Telegram\Chat $chat): self
    {
        $this->chat = $chat;

        return $this;
    }

    // ########################################

    /**
     * @return Collection|Subject[]
     */
    public function getSubjects(): Collection
    {
        return $this->subjects;
    }

    public function hasSubjects(): bool
    {
        return !$this->subjects->isEmpty();
    }

    public function addSubject(Subject $subject): self
    {
        if (!$this->subjects->contains($subject)) {
            $this->subjects[] = $subject;
        }

        return $this;
    }

    public function removeSubject(Subject $subject): self
    {
        if ($this->subjects->contains($subject)) {
            $this->subjects->removeElement($subject);
        }

        return $this;
    }

    public function hasSubject(Subject $subject): bool
    {
        foreach ($this->subjects as $userSubject) {
            if ($userSubject->getId() == $subject->getId()) {
                return true;
            }
        }

        return false;
    }

    // ########################################
}
