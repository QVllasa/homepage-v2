<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @Groups({"client_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"client_read"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"client_read"})
     */
    private $homepage;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"client_read"})
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="logos", fileNameProperty="image")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"client_read"})
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Project::class, mappedBy="client")
     */
    private $projects;

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Groups({"client_read"})
     */
    private $cssClass = [''];

    /**
     * @var string|null
     * @Groups({"client_read"})
     */
    public $contentUrl;

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

    public function getHomepage(): ?string
    {
        return $this->homepage;
    }

    public function setHomepage(string $homepage): self
    {
        $this->homepage = $homepage;

        return $this;
    }



    public function __toString()
    {
        return $this->name;
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
}
