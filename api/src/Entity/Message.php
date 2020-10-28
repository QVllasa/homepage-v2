<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      collectionOperations={"post"},
 *     itemOperations={
 *      "get"={"security"="is_granted('ROLE_ADMIN')"}
 *     },
 *     normalizationContext={
 *         "groups"="message_read"
 *     },
 *     denormalizationContext={
 *     "groups"="message_write"
 *     }
 * )
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"message_read"})
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"message_read", "message_write"})
     */
    private ?string $sendFrom;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({"message_read"})
     */
    private \DateTimeImmutable $sendAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"message_read", "message_write"})
     */
    private ?string $subject;

    /**
     * @ORM\Column(type="text")
     * @Groups({"message_read", "message_write"})
     */
    private ?string $content;

    public function __construct()
    {
        $this->sendAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSendFrom(): ?string
    {
        return $this->sendFrom;
    }

    public function setSendFrom(string $sendFrom): self
    {
        $this->sendFrom = $sendFrom;

        return $this;
    }

    public function getSendAt(): ?\DateTimeImmutable
    {
        return $this->sendAt;
    }

    public function setSendAt(\DateTimeImmutable $sendAt): self
    {
        $this->sendAt = $sendAt;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function __toString()
    {
        return $this->sendFrom;
    }
}
