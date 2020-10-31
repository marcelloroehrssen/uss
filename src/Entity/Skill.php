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
     * @ORM\OrderBy({"value" = "ASC"})
     * @Groups("exposed")
     */
    private $dots;

    /**
     * @ORM\OneToMany(targetEntity=Character::class, mappedBy="factionSkill")
     */
    private $charactersFactionsSkills;

    /**
     * @ORM\OneToMany(targetEntity=Character::class, mappedBy="discardedSkill")
     */
    private $charactersDiscardedSkills;

    /**
     * @ORM\ManyToMany(targetEntity=Character::class, mappedBy="jobSkills")
     */
    private $characterJobsSkills;

    /**
     * @ORM\OneToMany(targetEntity=CharacterSkill::class, mappedBy="skill")
     */
    private $characterSkills;

    public function __construct()
    {
        $this->dots = new ArrayCollection();
        $this->charactersFactionsSkills = new ArrayCollection();
        $this->charactersDiscardedSkills = new ArrayCollection();
        $this->characterJobsSkills = new ArrayCollection();
        $this->characterSkills = new ArrayCollection();
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

    /**
     * @return Collection|Character[]
     */
    public function getCharactersFactionsSkills(): Collection
    {
        return $this->charactersFactionsSkills;
    }

    public function addCharactersFactionsSkill(Character $charactersFactionsSkill): self
    {
        if (!$this->charactersFactionsSkills->contains($charactersFactionsSkill)) {
            $this->charactersFactionsSkills[] = $charactersFactionsSkill;
            $charactersFactionsSkill->setFactionSkill($this);
        }

        return $this;
    }

    public function removeCharactersFactionsSkill(Character $charactersFactionsSkill): self
    {
        if ($this->charactersFactionsSkills->contains($charactersFactionsSkill)) {
            $this->charactersFactionsSkills->removeElement($charactersFactionsSkill);
            // set the owning side to null (unless already changed)
            if ($charactersFactionsSkill->getFactionSkill() === $this) {
                $charactersFactionsSkill->setFactionSkill(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Character[]
     */
    public function getCharactersDiscardedSkills(): Collection
    {
        return $this->charactersDiscardedSkills;
    }

    public function addCharactersDiscardedSkill(Character $charactersDiscardedSkill): self
    {
        if (!$this->charactersDiscardedSkills->contains($charactersDiscardedSkill)) {
            $this->charactersDiscardedSkills[] = $charactersDiscardedSkill;
            $charactersDiscardedSkill->setDiscardedSkill($this);
        }

        return $this;
    }

    public function removeCharactersDiscardedSkill(Character $charactersDiscardedSkill): self
    {
        if ($this->charactersDiscardedSkills->contains($charactersDiscardedSkill)) {
            $this->charactersDiscardedSkills->removeElement($charactersDiscardedSkill);
            // set the owning side to null (unless already changed)
            if ($charactersDiscardedSkill->getDiscardedSkill() === $this) {
                $charactersDiscardedSkill->setDiscardedSkill(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Character[]
     */
    public function getCharacterJobsSkills(): Collection
    {
        return $this->characterJobsSkills;
    }

    public function addCharacterJobsSkill(Character $characterJobsSkill): self
    {
        if (!$this->characterJobsSkills->contains($characterJobsSkill)) {
            $this->characterJobsSkills[] = $characterJobsSkill;
            $characterJobsSkill->addJobSkill($this);
        }

        return $this;
    }

    public function removeCharacterJobsSkill(Character $characterJobsSkill): self
    {
        if ($this->characterJobsSkills->contains($characterJobsSkill)) {
            $this->characterJobsSkills->removeElement($characterJobsSkill);
            $characterJobsSkill->removeJobSkill($this);
        }

        return $this;
    }

    /**
     * @return Collection|CharacterSkill[]
     */
    public function getCharacterSkills(): Collection
    {
        return $this->characterSkills;
    }

    public function addCharacterSkill(CharacterSkill $characterSkill): self
    {
        if (!$this->characterSkills->contains($characterSkill)) {
            $this->characterSkills[] = $characterSkill;
            $characterSkill->setSkill($this);
        }

        return $this;
    }

    public function removeCharacterSkill(CharacterSkill $characterSkill): self
    {
        if ($this->characterSkills->contains($characterSkill)) {
            $this->characterSkills->removeElement($characterSkill);
            // set the owning side to null (unless already changed)
            if ($characterSkill->getSkill() === $this) {
                $characterSkill->setSkill(null);
            }
        }

        return $this;
    }
}
