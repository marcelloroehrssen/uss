<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterRepository::class)
 * @ORM\Table(name="`character`")
 */
class Character
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="characters")
     */
    private $user;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled = 0;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $modificationDate;

    /**
     * @ORM\Column(type="smallint")
     */
    private $mode = 1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=CharacterAttribute::class, mappedBy="characterSheet", orphanRemoval=true)
     */
    private $characterAttributes;

    /**
     * @ORM\ManyToOne(targetEntity=Faith::class, inversedBy="characters")
     */
    private $faith;

    /**
     * @ORM\ManyToOne(targetEntity=Faction::class, inversedBy="characters")
     */
    private $faction;

    /**
     * @ORM\ManyToOne(targetEntity=Job::class, inversedBy="characters")
     */
    private $job;

    /**
     * @ORM\ManyToOne(targetEntity=Skill::class, inversedBy="chractersFactionsSkills")
     */
    private $factionSkill;

    /**
     * @ORM\ManyToOne(targetEntity=Skill::class, inversedBy="charactersDiscardedSkills")
     */
    private $discardedSkill;

    /**
     * @ORM\ManyToMany(targetEntity=Skill::class, inversedBy="characterJobsSkills")
     */
    private $jobSkills;

    /**
     * @ORM\Column(type="smallint")
     */
    private $defectMode;

    /**
     * @ORM\ManyToMany(targetEntity=Defect::class, inversedBy="characters")
     */
    private $defects;

    /**
     * @ORM\OneToMany(targetEntity=CharacterSkill::class, mappedBy="characterSheet")
     */
    private $characterSkills;

    /**
     * @ORM\OneToMany(targetEntity=CharacterBackground::class, mappedBy="characterSheet")
     */
    private $characterBackgrounds;

    public function __construct()
    {
        $this->characterAttributes = new ArrayCollection();
        $this->jobSkills = new ArrayCollection();
        $this->defects = new ArrayCollection();
        $this->characterSkills = new ArrayCollection();
        $this->characterBackgrounds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getModificationDate(): ?\DateTimeInterface
    {
        return $this->modificationDate;
    }

    public function setModificationDate(\DateTimeInterface $modificationDate): self
    {
        $this->modificationDate = $modificationDate;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getMode(): ?int
    {
        return $this->mode;
    }

    public function setMode(int $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|CharacterAttribute[]
     */
    public function getCharacterAttributes(): Collection
    {
        return $this->characterAttributes;
    }

    public function addCharacterAttribute(CharacterAttribute $characterAttribute): self
    {
        if (!$this->characterAttributes->contains($characterAttribute)) {
            $this->characterAttributes[] = $characterAttribute;
            $characterAttribute->setCharacterSheet($this);
        }

        return $this;
    }

    public function removeCharacterAttribute(CharacterAttribute $characterAttribute): self
    {
        if ($this->characterAttributes->contains($characterAttribute)) {
            $this->characterAttributes->removeElement($characterAttribute);
            // set the owning side to null (unless already changed)
            if ($characterAttribute->getCharacterSheet() === $this) {
                $characterAttribute->setCharacterSheet(null);
            }
        }

        return $this;
    }

    public function getFaith(): ?Faith
    {
        return $this->faith;
    }

    public function setFaith(?Faith $faith): self
    {
        $this->faith = $faith;

        return $this;
    }

    public function getFaction(): ?Faction
    {
        return $this->faction;
    }

    public function setFaction(?Faction $faction): self
    {
        $this->faction = $faction;

        return $this;
    }

    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getFactionSkill(): ?Skill
    {
        return $this->factionSkill;
    }

    public function setFactionSkill(?Skill $factionSkill): self
    {
        $this->factionSkill = $factionSkill;

        return $this;
    }

    public function getDiscardedSkill(): ?Skill
    {
        return $this->discardedSkill;
    }

    public function setDiscardedSkill(?Skill $discardedSkill): self
    {
        $this->discardedSkill = $discardedSkill;

        return $this;
    }

    /**
     * @return Collection|Skill[]
     */
    public function getJobSkills(): Collection
    {
        return $this->jobSkills;
    }

    public function addJobSkill(Skill $jobSkill): self
    {
        if (!$this->jobSkills->contains($jobSkill)) {
            $this->jobSkills[] = $jobSkill;
        }

        return $this;
    }

    public function removeJobSkill(Skill $jobSkill): self
    {
        if ($this->jobSkills->contains($jobSkill)) {
            $this->jobSkills->removeElement($jobSkill);
        }

        return $this;
    }

    public function getDefectMode(): ?int
    {
        return $this->defectMode;
    }

    public function setDefectMode(int $defectMode): self
    {
        $this->defectMode = $defectMode;

        return $this;
    }

    /**
     * @return Collection|Defect[]
     */
    public function getDefects(): Collection
    {
        return $this->defects;
    }

    public function addDefect(Defect $defect): self
    {
        if (!$this->defects->contains($defect)) {
            $this->defects[] = $defect;
        }

        return $this;
    }

    public function removeDefect(Defect $defect): self
    {
        if ($this->defects->contains($defect)) {
            $this->defects->removeElement($defect);
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
            $characterSkill->setCharacterSheet($this);
        }

        return $this;
    }

    public function removeCharacterSkill(CharacterSkill $characterSkill): self
    {
        if ($this->characterSkills->contains($characterSkill)) {
            $this->characterSkills->removeElement($characterSkill);
            // set the owning side to null (unless already changed)
            if ($characterSkill->getCharacterSheet() === $this) {
                $characterSkill->setCharacterSheet(null);
            }
        }

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
            $characterBackground->setCharacterSheet($this);
        }

        return $this;
    }

    public function removeCharacterBackground(CharacterBackground $characterBackground): self
    {
        if ($this->characterBackgrounds->contains($characterBackground)) {
            $this->characterBackgrounds->removeElement($characterBackground);
            // set the owning side to null (unless already changed)
            if ($characterBackground->getCharacterSheet() === $this) {
                $characterBackground->setCharacterSheet(null);
            }
        }

        return $this;
    }
}