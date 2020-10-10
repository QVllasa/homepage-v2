<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProfileImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\DateTime;
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
    private ?string $image = '';

    /**
     * @Vich\UploadableField(mapping="images", fileNameProperty="image")
     * @Groups({"project_read"})
     */
    public File $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"profile_read"})
     */
    private ?string $title;

    /**
     * @var string|null
     * @Groups({"profile_read"})
     */
    public ?string $contentUrl = '';

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"project_read"})
     */
    private DateTime $updatedAt;

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
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
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
}
