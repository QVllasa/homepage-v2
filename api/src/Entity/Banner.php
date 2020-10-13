<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BannerRepository;
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
 *         "groups"={"banner_read"}
 *     },
 * )
 * @ORM\Entity(repositoryClass=BannerRepository::class)
 * @Vich\Uploadable()
 */
class Banner
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"banner_read"})
     */
    public ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"banner_read"})
     */
    public ?string $filename = '';

    /**
     * @Vich\UploadableField(mapping="media", fileNameProperty="filename")
     * @Groups({"banner_read"})
     */
    public ?File $file = null;



    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"banner_read"})
     */
    public ?string $title;


    public DateTime $updatedAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"banner_read"})
     */
    private ?int $priority;

    /**
     * @var string|null
     * @Groups({"banner_read"})
     */
    public ?string $contentUrl = '';

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"banner_read"})
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
     * @return File|null
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param File|null $file
     */
    public function setFile(?File $file): void
    {
        $this->file = $file;
        if($file){
            $updatedAt = new \DateTime();
        }
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

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(?int $priority): self
    {
        $this->priority = $priority;

        return $this;
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
