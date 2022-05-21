<?php

namespace App\Entity;

use App\Repository\VistorMessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VistorMessageRepository::class)
 */
class VistorMessage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subject;

    /**
     * @ORM\Column(type="text")
     */
    private $messageContent;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isArchived = false;

    /**
     * @ORM\OneToMany(targetEntity=VisitorEmailResponse::class, mappedBy="visitorMessage", orphanRemoval=true)
     */
    private $visitorEmailResponses;

    public function __construct()
    {
        $this->visitorEmailResponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessageContent(): ?string
    {
        return $this->messageContent;
    }

    public function setMessageContent(string $messageContent): self
    {
        $this->messageContent = $messageContent;

        return $this;
    }

    public function getIsArchived(): ?bool
    {
        return $this->isArchived;
    }

    public function setIsArchived(bool $isArchived): self
    {
        $this->isArchived = $isArchived;

        return $this;
    }

    /**
     * @return Collection<int, VisitorEmailResponse>
     */
    public function getVisitorEmailResponses(): Collection
    {
        return $this->visitorEmailResponses;
    }

    public function addVisitorEmailResponse(VisitorEmailResponse $visitorEmailResponse): self
    {
        if (!$this->visitorEmailResponses->contains($visitorEmailResponse)) {
            $this->visitorEmailResponses[] = $visitorEmailResponse;
            $visitorEmailResponse->setVisitorMessage($this);
        }

        return $this;
    }

    public function removeVisitorEmailResponse(VisitorEmailResponse $visitorEmailResponse): self
    {
        if ($this->visitorEmailResponses->removeElement($visitorEmailResponse)) {
            // set the owning side to null (unless already changed)
            if ($visitorEmailResponse->getVisitorMessage() === $this) {
                $visitorEmailResponse->setVisitorMessage(null);
            }
        }

        return $this;
    }
}
