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
    const MACRO_TYPE_TOOL = 'armi';
    const MACRO_TYPE_BUILDING = 'edifici';
    const MACRO_TYPE_TERRAIN = 'terreni';

    const TYPE_WEAPON = 'armi';
    const TYPE_ARMOR_SHIELD = 'armature scudi';
    const TYPE_CRAFT_TOOL = 'attrezzi da artigianato';
    const TYPE_ST_TOOL = 'attrezzi in narrativa';
    const TYPE_TRANSPORT = 'attrezzi in narrativa';
    const TYPE_MONOUSO = 'oggetti monouso';
    const TYPE_RESOURCE = 'risorse';
    const TYPE_DRESS = 'vestiti';
    const TYPE_OTHER = 'varie';

    const MACRO_TYPES = [
        self::MACRO_TYPE_TOOL => self::MACRO_TYPE_TOOL,
        self::MACRO_TYPE_BUILDING => self::MACRO_TYPE_BUILDING,
        self::MACRO_TYPE_TERRAIN => self::MACRO_TYPE_TERRAIN
    ];

    const TYPES = [
        self::TYPE_WEAPON => self::TYPE_WEAPON,
        self::TYPE_ARMOR_SHIELD => self::TYPE_ARMOR_SHIELD,
        self::TYPE_CRAFT_TOOL => self::TYPE_CRAFT_TOOL,
        self::TYPE_ST_TOOL => self::TYPE_ST_TOOL,
        self::TYPE_TRANSPORT => self::TYPE_TRANSPORT,
        self::TYPE_MONOUSO => self::TYPE_MONOUSO,
        self::TYPE_RESOURCE => self::TYPE_RESOURCE,
        self::TYPE_DRESS => self::TYPE_DRESS,
        self::TYPE_OTHER => self::TYPE_OTHER,
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("exposed")
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
    private $cost = 0;

    /**
     * @ORM\Column(type="integer")
     * @Groups("exposed")
     */
    private $costSell = 0;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled = 1;

    /**
     * @ORM\ManyToMany(targetEntity=DowntimeDefinition::class, mappedBy="items")
     */
    private $downtimeDefinitions;

    /**
     * @ORM\Column(type="integer")
     * @Groups("exposed")
     */
    private $dots = 1;

    /**
     * @ORM\Column(type="integer")
     * @Groups("exposed")
     */
    private $value = 1;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("exposed")
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     * @Groups("exposed")
     */
    private $max = 0;

    /**
     * @ORM\Column(type="integer")
     * @Groups("exposed")
     */
    private $bonus = 0;

    /**
     * @ORM\Column(type="integer")
     * @Groups("exposed")
     */
    private $structPoint = 0;

    /**
     * @ORM\Column(type="boolean")
     */
    private $onlyInCreation = true;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $macroCategory;

    /**
     * @ORM\ManyToMany(targetEntity=Recipe::class, mappedBy="items")
     */
    private $recipes;


    public function __construct()
    {
        $this->inventoryEntries = new ArrayCollection();
        $this->downtimeDefinitions = new ArrayCollection();
        $this->recipes = new ArrayCollection();
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

    public function getDots(): ?int
    {
        return $this->dots;
    }

    public function setDots(int $dots): self
    {
        $this->dots = $dots;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function setMax(int $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function getCostSell(): ?int
    {
        return $this->costSell;
    }

    public function setCostSell(int $costSell): self
    {
        $this->costSell = $costSell;

        return $this;
    }

    public function getBonus(): ?int
    {
        return $this->bonus;
    }

    public function setBonus(int $bonus): self
    {
        $this->bonus = $bonus;

        return $this;
    }

    public function getStructPoint(): ?int
    {
        return $this->structPoint;
    }

    public function setStructPoint(int $structPoint): self
    {
        $this->structPoint = $structPoint;

        return $this;
    }

    public function getOnlyInCreation(): ?bool
    {
        return $this->onlyInCreation;
    }

    public function setOnlyInCreation(bool $onlyInCreation): self
    {
        $this->onlyInCreation = $onlyInCreation;

        return $this;
    }

    public function getMacroCategory(): ?string
    {
        return $this->macroCategory;
    }

    public function setMacroCategory(string $macroCategory): self
    {
        $this->macroCategory = $macroCategory;

        return $this;
    }

    /**
     * @return Collection|Recipe[]
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
            $recipe->addItem($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->contains($recipe)) {
            $this->recipes->removeElement($recipe);
            $recipe->removeItem($this);
        }

        return $this;
    }
}
