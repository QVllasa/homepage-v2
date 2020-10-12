<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ServiceRepository;
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
 *         "groups"={"service_read"}
 *     },
 * )
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 * @Vich\Uploadable()
 */
class Service
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"service_read"})
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"service_read"})
     */
    private ?string $title;

    /**
     * @ORM\Column(type="text")
     * @Groups({"service_read"})
     */
    private ?string $shortText;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"service_read"})
     */
    private ?string $filename = '';

    /**
     * @Vich\UploadableField(mapping="media", fileNameProperty="filename")
     */
    private File $file;

    /**
     * @var string|null
     * @Groups({"service_read"})
     */
    public ?string $contentUrl;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"service_read"})
     */
    private \DateTime $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=ServiceSection::class, mappedBy="service")
     * @Groups({"service_read"})
     */
    private  $serviceSections;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"service_read"})
     */
    private ?int $priority;

    /**
     * @ORM\Column(type="string", length=255,   nullable=true)
     * @Groups({"service_read"})
     */
    private ?string $pageTitle;



    public function __construct()
    {
        $this->updatedAt = new \DateTime();
        $this->serviceSections = new ArrayCollection();
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

    public function getShortText(): ?string
    {
        return $this->shortText;
    }

    public function setShortText(string $shortText): self
    {
        $this->shortText = $shortText;

        return $this;
    }



    /**
     * @return Collection|ServiceSection[]
     */
    public function getServiceSections(): Collection
    {
        return $this->serviceSections;
    }

    public function addServiceSection(ServiceSection $serviceSection): self
    {
        if (!$this->serviceSections->contains($serviceSection)) {
            $this->serviceSections[] = $serviceSection;
            $serviceSection->setService($this);
        }

        return $this;
    }

    public function removeServiceSection(ServiceSection $serviceSection): self
    {
        if ($this->serviceSections->contains($serviceSection)) {
            $this->serviceSections->removeElement($serviceSection);
            // set the owning side to null (unless already changed)
            if ($serviceSection->getService() === $this) {
                $serviceSection->setService(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->title;
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

    public function getPageTitle(): ?string
    {
        return $this->pageTitle;
    }

    public function setPageTitle(string $pageTitle): self
    {
        $this->pageTitle = $pageTitle;

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

}
