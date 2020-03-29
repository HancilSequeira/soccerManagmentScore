<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="players")
 * @ORM\Entity(repositoryClass="App\Repository\PlayersRepository")
 * @ORM\HasLifecycleCallbacks
 *
 */
class Players
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $playerImageUri;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TeamPlayer", mappedBy="player")
     */
    private $teamPlayer;

    /**
     * Action to be taken before persist.
     *
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->updatedAt = new \DateTime();
        $this->createdAt = new \DateTime();
    }

    /**
     * Action to be taken before update.
     *
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPlayerImageUri(): ?string
    {
        return $this->playerImageUri;
    }

    public function setPlayerImageUri(string $playerImageUri): self
    {
        $this->playerImageUri = $playerImageUri;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTeamPlayer()
    {
        return $this->teamPlayer;
    }

    /**
     * @param mixed $teamPlayer
     */
    public function setTeamPlayer($teamPlayer): void
    {
        $this->teamPlayer = $teamPlayer;
    }

}
