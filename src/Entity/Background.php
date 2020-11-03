<?php

namespace App\Entity;

use App\Repository\BackgroundRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=BackgroundRepository::class)
 */
class Background
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
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("exposed")
     */
    private $bonus;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("exposed")
     */
    private $extra;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("exposed")
     */
    private $malus;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("exposed")
     */
    private $keep;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("exposed")
     */
    private $note;

    /**
     * @ORM\OneToMany(targetEntity=BackgroundDot::class, mappedBy="background")
     * @ORM\OrderBy({"value" = "ASC"})
     * @Groups("exposed")
     */
    private $dots;

    /**
     * @ORM\Column(type="integer")
     * @Groups("exposed")
     */
    private $count = 0;

    /**
     * @ORM\Column(type="integer")
     * @Groups("exposed")
     */
    private $costType;

    /**
     * @ORM\OneToMany(targetEntity=CharacterBackground::class, mappedBy="background")
     */
    private $characterBackgrounds;

    public function __construct()
    {
        $this->dot = new ArrayCollection();
        $this->characterBackgrounds = new ArrayCollection();
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

    public function getBonus(): ?string
    {
        return $this->bonus;
    }

    public function setBonus(?string $bonus): self
    {
        $this->bonus = $bonus;

        return $this;
    }

    public function getExtra(): ?string
    {
        return $this->extra;
    }

    public function setExtra(?string $extra): self
    {
        $this->extra = $extra;

        return $this;
    }

    public function getMalus(): ?string
    {
        return $this->malus;
    }

    public function setMalus(?string $malus): self
    {
        $this->malus = $malus;

        return $this;
    }

    public function getKeep(): ?string
    {
        return $this->keep;
    }

    public function setKeep(?string $keep): self
    {
        $this->keep = $keep;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Collection|BackgroundDot[]
     */
    public function getDots(): ?Collection
    {
        return $this->dots;
    }

    public function addDot(BackgroundDot $dot): self
    {
        if (!$this->dots->contains($dot)) {
            $this->dots[] = $dot;
            $dot->setBackground($this);
        }

        return $this;
    }

    public function removeDot(BackgroundDot $dot): self
    {
        if ($this->dots->contains($dot)) {
            $this->dots->removeElement($dot);
            // set the owning side to null (unless already changed)
            if ($dot->getBackground() === $this) {
                $dot->setBackground(null);
            }
        }

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getCostType(): ?int
    {
        return $this->costType;
    }

    public function setCostType(int $costType): self
    {
        $this->costType = $costType;

        return $this;
    }

    /**
     * @return Collection|CharacterBackground[]
     */
    public function getCharacterBackgrounds(): Collection
    {
        return $this->characterBackgrounds;
    }

    public function addCharacterBackground(CharacterBackground $characterBackground): self
    {
        if (!$this->characterBackgrounds->contains($characterBackground)) {
            $this->characterBackgrounds[] = $characterBackground;
            $characterBackground->setBackgrounds($this);
        }

        return $this;
    }

    public function removeCharacterBackground(CharacterBackground $characterBackground): self
    {
        if ($this->characterBackgrounds->contains($characterBackground)) {
            $this->characterBackgrounds->removeElement($characterBackground);
            // set the owning side to null (unless already changed)
            if ($characterBackground->getBackgrounds() === $this) {
                $characterBackground->setBackgrounds(null);
            }
        }

        return $this;
    }
}
