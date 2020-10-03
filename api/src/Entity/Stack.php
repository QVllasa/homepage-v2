<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StackRepository;
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
 *         "groups"={"stack_read"}
 *     },
 * )
 * @ORM\Entity(repositoryClass=StackRepository::class)
 * @Vich\Uploadable()
 */
class Stack
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"stack_read"})
     */
    private $title;


    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"stack_read"})
     */
    private $url;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @Vich\UploadableField(mapping="logos", fileNameProperty="logo")
     */
    private $logoFile;

    /**
     * @var string|null
     * @Groups({"stack_read"})
     */
    public $contentUrl;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"stack_read"})
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

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogoFile()
    {
        return $this->logoFile;
    }

    /**
     * @param mixed $logoFile
     */
    public function setLogoFile($logoFile): void
    {
        $this->logoFile = $logoFile;

        if($logoFile){
            $this->updatedAt = new \DateTime();
        }
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo): void
    {
        $this->logo = $logo;

    }
}
