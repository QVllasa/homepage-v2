<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProfileImageRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Resolver\GetMediaObjectCollectionResolver;
use App\Resolver\GetMediaObjectResolver;

/**
 * @ApiResource(
 *     graphql={
 *      "collection_query"={"collection_query"=GetMediaObjectCollectionResolver::class},
 *     "item_query"={"item_query"=GetMediaObjectResolver::class},
 *     },
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *     normalizationContext={
 *         "groups"={"profile_read"}
 *     },
 * )
 * @ORM\Entity(repositoryClass=ProfileImageRepository::class)
 * @Vich\Uploadable()
 */
class ProfileImage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"profile_read"})
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"profile_read"})
     */
    private ?string $filename = '';

    /**
     * @Vich\UploadableField(mapping="media", fileNameProperty="filename")
     * @Groups({"profile_read"})
     */
    public File $file;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"profile_read"})
     */
    private ?string $title = '';

    /**
     * @var string|null
     * @Groups({"profile_read"})
     */
    public ?string $contentUrl = '';

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"profile_read"})
     */
    private DateTime $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"profile_read"})
     */
    private ?string $mimeType;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $convert;

    public function __construct()
    {

        $this->updatedAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     */
    public function setFilename(?string $filename): void
    {
        $this->filename = $filename;
    }

    /**
     * @return File
     */
    public function getFile(): File
    {
        return $this->file;
    }

    /**
     * @param File $file
     */
    public function setFile(File $file): void
    {
        $this->file = $file;
        if ($file) {
            $this->updatedAt = new \DateTime();
        }
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function setMimeType(?string $mimeType): self
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    public function getConvert(): ?bool
    {
        return $this->convert;
    }

    public function setConvert(?bool $convert): self
    {
        $this->convert = $convert;

        return $this;
    }
}
