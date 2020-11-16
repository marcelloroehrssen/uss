<?php

namespace App\Entity;

use App\Repository\DowntimeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=DowntimeRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Downtime
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("exposed")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("exposed")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Character::class, inversedBy="downtimes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $characterSheet;

    /**
     * @ORM\OneToMany(targetEntity=InventoryEntry::class, mappedBy="downtime", fetch="EAGER")
     * @Groups("exposed")
     */
    private $relatedItems;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("exposed")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="downtimes")
     * @Groups("exposed")
     */
    private $recipe;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("exposed")
     */
    private $resolution;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("exposed")
     */
    private $resolutionTime;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="downtimes")
     */
    private $storyTeller;

    /**
     * @ORM\OneToMany(targetEntity=DowntimeComment::class, mappedBy="downtime", cascade={"remove"})
     */
    private $comments;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("exposed")
     */
    private $createdAt;

    public function __construct()
    {
        $this->relatedItems = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCharacterSheet(): ?Character
    {
        return $this->characterSheet;
    }

    public function setCharacterSheet(?Character $characterSheet): self
    {
        $this->characterSheet = $characterSheet;

        return $this;
    }

    public function setRelatedItems($items): self
    {
        $this->relatedItems = $items;

        return $this;
    }

    /**
     * @return Collection|InventoryEntry[]
     */
    public function getRelatedItems(): Collection
    {
        return $this->relatedItems;
    }

    public function addRelatedItem(InventoryEntry $relatedItem): self
    {
        if (!$this->relatedItems->contains($relatedItem)) {
            $this->relatedItems[] = $relatedItem;
            $relatedItem->setDowntime($this);
        }

        return $this;
    }

    public function removeRelatedItem(InventoryEntry $relatedItem): self
    {
        if ($this->relatedItems->contains($relatedItem)) {
            $this->relatedItems->removeElement($relatedItem);
            // set the owning side to null (unless already changed)
            if ($relatedItem->getDowntime() === $this) {
                $relatedItem->setDowntime(null);
            }
        }

        return $this;
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

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getResolution(): ?string
    {
        return $this->resolution;
    }

    public function setResolution(?string $resolution): self
    {
        $this->resolution = $resolution;

        return $this;
    }

    public function getResolutionTime(): ?\DateTimeInterface
    {
        return $this->resolutionTime;
    }

    public function setResolutionTime(?\DateTimeInterface $resolutionTime): self
    {
        $this->resolutionTime = $resolutionTime;

        return $this;
    }

    public function getStoryTeller(): ?User
    {
        return $this->storyTeller;
    }

    public function setStoryTeller(?User $storyTeller): self
    {
        $this->storyTeller = $storyTeller;

        return $this;
    }

    /**
     * @return Collection|DowntimeComment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(DowntimeComment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setDowntime($this);
        }

        return $this;
    }

    public function removeComment(DowntimeComment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getDowntime() === $this) {
                $comment->setDowntime(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        if (null === $this->createdAt) {
            $this->createdAt = new \DateTime();
        }
    }
}
