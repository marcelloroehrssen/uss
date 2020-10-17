<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SkillRepository::class)
 */
class Skill
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
     * @ORM\Column(type="text")
     * @Groups("exposed")
     */
    private $description2;

    /**
     * @ORM\Column(type="text")
     * @Groups("exposed")
     */
    private $note;

    /**
     * @ORM\OneToMany(targetEntity=SkillDot::class, mappedBy="skill")
     * @Groups("exposed")
     */
    private $dots;

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

    public function getDescription2(): ?string
    {
        return $this->description2;
    }

    public function setDescription2(string $description2): self
    {
        $this->description2 = $description2;

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
     * @return Collection|SkillDot[]
     */
    public function getDots(): Collection
    {
        return $this->dots;
    }

    public function addDot(SkillDot $dot): self
    {
        if (!$this->dots->contains($dot)) {
            $this->dots[] = $dot;
            $dot->setSkill($this);
        }

        return $this;
    }

    public function removeDot(SkillDot $dot): self
    {
        if ($this->dots->contains($dot)) {
            $this->dots->removeElement($dot);
            // set the owning side to null (unless already changed)
            if ($dot->getSkill() === $this) {
                $dot->setSkill(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
