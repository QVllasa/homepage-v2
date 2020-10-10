<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
 *         "groups"={"client_read"}
 *     },
 * )
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 * @Vich\Uploadable()
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"client_read", "project_read"})
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"client_read", "project_read"})
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"client_read", "project_read"})
     */
    private ?string $url = '';

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"client_read", "project_read"})
     */
    private ?string $filename = '';

    /**
     * @Vich\UploadableField(mapping="logos", fileNameProperty="image")
     */
    private File $file;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"client_read", "project_read"})
     */
    private \DateTime $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Project::class, mappedBy="client")
     */
    private ArrayCollection $projects;

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Groups({"client_read", "project_read"})
     */
    private ?array $cssClass = [''];

    /**
     * @var string|null
     * @Groups({"client_read", "project_read"})
     */
    public ?string $contentUrl;

    public function __construct()
    {

        $this->updatedAt = new \DateTime();
        $this->projects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }





    public function __toString()
    {
        return $this->name;
    }


    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setClient($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getClient() === $this) {
                $project->setClient(null);
            }
        }

        return $this;
    }

    public function getCssClass(): ?array
    {
        return $this->cssClass;
    }

    public function setCssClass(?array $cssClass): self
    {
        $this->cssClass = $cssClass;

        return $this;
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

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }
}
