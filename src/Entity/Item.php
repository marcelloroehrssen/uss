<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 * @Vich\Uploadable
 */
class Item
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("exposed")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups("exposed")
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("exposed")
     */
    private $isConsumable;

    /**
     * @Vich\UploadableField(mapping="item_image", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("exposed")
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     */
    private $uploadedAt;

    /**
     * @ORM\OneToMany(targetEntity=InventoryEntry::class, mappedBy="item")
     */
    private $inventoryEntries;

    /**
     * @ORM\Column(type="integer")
     * @Groups("exposed")
     */
    private $cost;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled = 1;

    /**
     * @ORM\ManyToMany(targetEntity=DowntimeDefinition::class, mappedBy="items")
     */
    private $downtimeDefinitions;

    public function __construct()
    {
        $this->inventoryEntries = new ArrayCollection();
        $this->downtimeDefinitions = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsConsumable(): ?bool
    {
        return $this->isConsumable;
    }

    public function setIsConsumable(bool $isConsumable): self
    {
        $this->isConsumable = $isConsumable;

        return $this;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->uploadedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getUploadedAt(): ?\DateTimeInterface
    {
        return $this->uploadedAt;
    }

    public function setUploadedAt(\DateTimeInterface $uploadedAt): self
    {
        $this->uploadedAt = $uploadedAt;

        return $this;
    }

    /**
     * @return Collection|InventoryEntry[]
     */
    public function getInventoryEntries(): Collection
    {
        return $this->inventoryEntries;
    }

    public function addInventoryEntry(InventoryEntry $inventoryEntry): self
    {
        if (!$this->inventoryEntries->contains($inventoryEntry)) {
            $this->inventoryEntries[] = $inventoryEntry;
            $inventoryEntry->setItem($this);
        }

        return $this;
    }

    public function removeInventoryEntry(InventoryEntry $inventoryEntry): self
    {
        if ($this->inventoryEntries->contains($inventoryEntry)) {
            $this->inventoryEntries->removeElement($inventoryEntry);
            // set the owning side to null (unless already changed)
            if ($inventoryEntry->getItem() === $this) {
                $inventoryEntry->setItem(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(int $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return Collection|DowntimeDefinition[]
     */
    public function getDowntimeDefinitions(): Collection
    {
        return $this->downtimeDefinitions;
    }

    public function addDowntimeDefinition(DowntimeDefinition $downtimeDefinition): self
    {
        if (!$this->downtimeDefinitions->contains($downtimeDefinition)) {
            $this->downtimeDefinitions[] = $downtimeDefinition;
            $downtimeDefinition->addItem($this);
        }

        return $this;
    }

    public function removeDowntimeDefinition(DowntimeDefinition $downtimeDefinition): self
    {
        if ($this->downtimeDefinitions->contains($downtimeDefinition)) {
            $this->downtimeDefinitions->removeElement($downtimeDefinition);
            $downtimeDefinition->removeItem($this);
        }

        return $this;
    }
}
