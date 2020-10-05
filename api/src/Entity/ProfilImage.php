<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProfilImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
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
 * @ORM\Entity(repositoryClass=ProfilImageRepository::class)
 * @Vich\Uploadable()
 */
class ProfilImage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"profile_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"profile_read"})
     */
    private $path;

    /**
     * @Vich\UploadableField(mapping="images", fileNameProperty="path")
     * @Groups({"project_read"})
     */
    private $pathFile;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"profile_read"})
     */
    private $title;


    /**
     * @var string|null
     * @Groups({"profile_read"})
     */
    public $contentUrl;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"project_read"})
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

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
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
            $this->updatedAt = new \DateTime();
        }
    }
}
