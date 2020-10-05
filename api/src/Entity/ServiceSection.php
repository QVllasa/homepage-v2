<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ServiceSectionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Resolver\GetMediaObjectResolver;
use App\Resolver\GetMediaObjectCollectionResolver;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ApiResource(
 *     graphql={
 *      "collection_query"={"collection_query"=GetMediaObjectCollectionResolver::class},
 *     "item_query"={"item_query"=GetMediaObjectResolver::class},
 *     },
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *     normalizationContext={
 *         "groups"={"service_section_read"}
 *     },
 * )
 * @ORM\Entity(repositoryClass=ServiceSectionRepository::class)
 * @Vich\Uploadable()
 */
class ServiceSection
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"service_section_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"service_section_read"})
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"service_section_read"})
     */
    private $description;

    /**
     * @ORM\Column(type="array", nullable=true)
     *
     * @Groups({"service_section_read"})
     */
    private $keys = [];

    /**
     * @ORM\ManyToOne(targetEntity=Service::class, inversedBy="serviceSections")
     * @Groups({"service_section_read"})
     */
    private $service;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"service_section_read"})
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="logos", fileNameProperty="image")
     */
    private $imageFile;

    /**
     * @var string|null
     * @Groups({"service_section_read"})
     */
    public $contentUrl;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"service_section_read"})
     */
    private $updatedAt;

    public function __construct()
    {
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getKeys(): ?array
    {
        return $this->keys;
    }

    public function setKeys(?array $keys): self
    {
        $this->keys = $keys;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param mixed $imageFile
     */
    public function setImageFile($imageFile): void
    {
        $this->imageFile = $imageFile;
        if($imageFile){
            $this->updatedAt = new \DateTime();
        }
    }

    public function __toString()
    {
        return $this->title;
    }
}
