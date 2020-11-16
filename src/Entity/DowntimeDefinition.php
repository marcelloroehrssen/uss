<?php

namespace App\Entity;

use App\Repository\DowntimeDefinitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass=DowntimeDefinitionRepository::class)
 */
class DowntimeDefinition
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
     * @ORM\Column(type="text")
     * @Groups("exposed")
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("exposed")
     */
    private $note;

    /**
     * @ORM\ManyToMany(targetEntity=Item::class, inversedBy="downtimeDefinitions")
     * @Groups("exposed")
     */
    private $items;

    /**
     * @ORM\Column(type="integer")
     * @Groups("exposed")
     */
    private $challenge;

    /**
     * @ORM\OneToMany(targetEntity=Recipe::class, mappedBy="downtimeDefinition")
     * @Groups("exposed")
     */
    private $recipes;

    /**
     * @ORM\ManyToOne(targetEntity=Attribute::class)
     */
    private $attribute;

    /**
     * @ORM\ManyToOne(targetEntity=Skill::class)
     */
    private $skill;

    public function __construct()
    {
        $this->items = new ArrayCollection();
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

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

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

    public function __toString()
    {
        return $this->name;
    }

    public function getChallenge(): ?int
    {
        return $this->challenge;
    }

    public function setChallenge(int $challenge): self
    {
        $this->challenge = $challenge;

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
            $recipe->setDowntimeDefinition($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->contains($recipe)) {
            $this->recipes->removeElement($recipe);
            // set the owning side to null (unless already changed)
            if ($recipe->getDowntimeDefinition() === $this) {
                $recipe->setDowntimeDefinition(null);
            }
        }

        return $this;
    }

    public function getAttribute(): ?Attribute
    {
        return $this->attribute;
    }

    public function setAttribute(?Attribute $attribute): self
    {
        $this->attribute = $attribute;

        return $this;
    }

    public function getSkill(): ?Skill
    {
        return $this->skill;
    }

    public function setSkill(?Skill $skill): self
    {
        $this->skill = $skill;

        return $this;
    }
}
