<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Team
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logoURI;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TeamPlayer", mappedBy="team")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLogoURI(): ?string
    {
        return $this->logoURI;
    }

    public function setLogoURI(string $logoURI): self
    {
        $this->logoURI = $logoURI;

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
