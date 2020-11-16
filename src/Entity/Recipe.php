<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
{
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
     * @ORM\ManyToOne(targetEntity=DowntimeDefinition::class, inversedBy="recipes")
     */
    private $downtimeDefinition;

    /**
     * @ORM\ManyToMany(targetEntity=Item::class, inversedBy="recipes")
     * @Groups("exposed")
     */
    private $items;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("exposed")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Downtime::class, mappedBy="recipe")
     * @Groups("exposed")
     */
    private $downtimes;

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->downtimes = new ArrayCollection();
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

    public function getDowntimeDefinition(): ?DowntimeDefinition
    {
        return $this->downtimeDefinition;
    }

    public function setDowntimeDefinition(?DowntimeDefinition $downtimeDefinition): self
    {
        $this->downtimeDefinition = $downtimeDefinition;

        return $this;
    }

    /**
     * @return Collection|Item[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Downtime[]
     */
    public function getDowntimes(): Collection
    {
        return $this->downtimes;
    }

    /**
     * @param Collection|Downtime[] $downtimes
     * @return Recipe
     */
    public function setDowntimes($downtimes): self
    {
        $this->downtimes = $downtimes;

        return $this;
    }

    public function addDowntime(Downtime $downtime): self
    {
        if (!$this->downtimes->contains($downtime)) {
            $this->downtimes[] = $downtime;
            $downtime->setRecipe($this);
        }

        return $this;
    }

    public function removeDowntime(Downtime $downtime): self
    {
        if ($this->downtimes->contains($downtime)) {
            $this->downtimes->removeElement($downtime);
            // set the owning side to null (unless already changed)
            if ($downtime->getRecipe() === $this) {
                $downtime->setRecipe(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
