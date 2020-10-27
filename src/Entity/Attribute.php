<?php

namespace App\Entity;

use App\Repository\AttributeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @ORM\Entity(repositoryClass=AttributeRepository::class)
 */
class Attribute
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
    private $description1;

    /**
     * @ORM\OneToMany(targetEntity=AttributeDot::class, mappedBy="attribute", orphanRemoval=true, fetch="EAGER")
     * @ORM\OrderBy({"value" = "ASC"})
     * @Groups("exposed")
     */
    private $dots;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("exposed")
     * @SerializedName("id")
     */
    private $externalId;

    public function __construct()
    {
        $this->dots = new ArrayCollection();
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

    public function getDescription1(): ?string
    {
        return $this->description1;
    }

    public function setDescription1(string $description1): self
    {
        $this->description1 = $description1;

        return $this;
    }

    /**
     * @return Collection|Dot[]
     */
    public function getDots(): Collection
    {
        return $this->dots;
    }

    public function addDot(Dot $dot): self
    {
        if (!$this->dots->contains($dot)) {
            $this->dots[] = $dot;
            $dot->setAttribute($this);
        }

        return $this;
    }

    public function removeDot(Dot $dot): self
    {
        if ($this->dots->contains($dot)) {
            $this->dots->removeElement($dot);
            // set the owning side to null (unless already changed)
            if ($dot->getAttribute() === $this) {
                $dot->setAttribute(null);
            }
        }

        return $this;
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): self
    {
        $this->externalId = $externalId;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
