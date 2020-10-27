<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=JobRepository::class)
 */
class Job
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
     * @ORM\Column(type="text")
     * @Groups("exposed")
     */
    private $cite;

    /**
     * @ORM\ManyToOne(targetEntity=JobType::class, inversedBy="jobs")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("exposed")
     */
    private $requisite;

    /**
     * @ORM\OneToMany(targetEntity=SkillGroup::class, mappedBy="job", orphanRemoval=true)
     * @Groups("exposed")
     */
    private $skillGroups;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups("exposed")
     */
    private $canHaveWife = true;

    public function __construct()
    {
        $this->skillGroups = new ArrayCollection();
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

    public function getCite(): ?string
    {
        return $this->cite;
    }

    public function setCite(string $cite): self
    {
        $this->cite = $cite;

        return $this;
    }

    public function getRequisite(): ?JobType
    {
        return $this->requisite;
    }

    public function setRequisite(?JobType $requisite): self
    {
        $this->requisite = $requisite;

        return $this;
    }

    /**
     * @return Collection|SkillGroup[]
     */
    public function getSkillGroups(): Collection
    {
        return $this->skillGroups;
    }

    public function addSkillGroup(SkillGroup $skillGroup): self
    {
        if (!$this->skillGroups->contains($skillGroup)) {
            $this->skillGroups[] = $skillGroup;
            $skillGroup->setJob($this);
        }

        return $this;
    }

    public function removeSkillGroup(SkillGroup $skillGroup): self
    {
        if ($this->skillGroups->contains($skillGroup)) {
            $this->skillGroups->removeElement($skillGroup);
            // set the owning side to null (unless already changed)
            if ($skillGroup->getJob() === $this) {
                $skillGroup->setJob(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getCanHaveWife(): ?bool
    {
        return $this->canHaveWife;
    }

    public function setCanHaveWife(?bool $canHaveWife): self
    {
        $this->canHaveWife = $canHaveWife;

        return $this;
    }
}
