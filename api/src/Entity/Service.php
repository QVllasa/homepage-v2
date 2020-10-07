<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ServiceRepository;
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
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"service_read"})
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Groups({"service_read"})
     */
    private $shortText;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"service_read"})
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="logos", fileNameProperty="image")
     */
    private $imageFile;

    /**
     * @var string|null
     * @Groups({"service_read"})
     */
    public $contentUrl;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"service_read"})
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=ServiceSection::class, mappedBy="service")
     * @Groups({"service_read"})
     */
    private $serviceSections;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"service_read"})
     */
    private $priority;

    /**
     * @ORM\Column(type="string", length=255,   nullable=true)
     * @Groups({"service_read"})
     */
    private $pageTitle;



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

}
