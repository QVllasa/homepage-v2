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
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"banner_read"})
     */
    private ?string $filename = '';

    /**
     * @Vich\UploadableField(mapping="images", fileNameProperty="filename")
     * @Groups({"banner_read"})
     */
    private ?File $file;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"banner_read"})
     */
    private ?string $title;


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

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPathFile()
    {
        return $this->pathFile;
    }

    /**
     * @param mixed $pathFile
     */
    public function setPathFile($pathFile): void
    {
        $this->pathFile = $pathFile;

        if($pathFile){
            $updatedAt = new \DateTime();
        }
    }
}
