<?php

namespace App\Entity;

use App\Repository\DowntimeDefinitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DowntimeDefinitionRepository::class)
 */
class DowntimeDefinition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;

    /**
     * @ORM\ManyToMany(targetEntity=Item::class, inversedBy="downtimeDefinitions")
     */
    private $items;

    /**
     * @ORM\OneToMany(targetEntity=Downtime::class, mappedBy="downTimeDefinition")
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

    /**
     * @return Collection|Downtime[]
     */
    public function getDowntimes(): Collection
    {
        return $this->downtimes;
    }

    public function addDowntime(Downtime $downtime): self
    {
        if (!$this->downtimes->contains($downtime)) {
            $this->downtimes[] = $downtime;
            $downtime->setDownTimeDefinition($this);
        }

        return $this;
    }

    public function removeDowntime(Downtime $downtime): self
    {
        if ($this->downtimes->contains($downtime)) {
            $this->downtimes->removeElement($downtime);
            // set the owning side to null (unless already changed)
            if ($downtime->getDownTimeDefinition() === $this) {
                $downtime->setDownTimeDefinition(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
