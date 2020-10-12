<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Resolver\GetMediaObjectResolver;
use App\Resolver\GetMediaObjectCollectionResolver;

/**
 * @ApiResource(
 *     graphql={
 *      "collection_query"={"collection_query"=GetMediaObjectCollectionResolver::class},
 *     "item_query"={"item_query"=GetMediaObjectResolver::class},
 *     },
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *     normalizationContext={
 *         "groups"={"project_read"}
 *     },
 * )
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 * @Vich\Uploadable()
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"project_read"})
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"project_read"})
     */
    private ?string $title;


    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"project_read"})
     */
    private ?string $description;

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Groups({"project_read"})
     */
    private ?array $keys = [];

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"project_read"})
     */
    private \DateTime $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="projects")
     * @Groups({"project_read"})
     */
    private  $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"project_read"})
     */
    private ?string $filename;

    /**
     * @Vich\UploadableField(mapping="media", fileNameProperty="filename")
     */
    private File $file;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $updatedAt;


    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="projects")
     * @Groups({"project_read"})
     */
    private ?Client $client;

    /**
     * @var string|null
     * @Groups({"project_read"})
     */
    public $contentUrl;

    public function __construct()
    {
        $this->updatedAt = new \DateTime();
        $this->createdAt = new \DateTime();
        $this->category = new ArrayCollection();
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



    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getKeys(): ?array
    {
        return $this->keys;
    }

    public function setKeys(array $keys): self
    {
        $this->keys = $keys;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }



    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
        }

        return $this;
    }



    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file): void
    {
        $this->file = $file;
        if($file){
            $this->updatedAt = new \DateTime();
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
}
