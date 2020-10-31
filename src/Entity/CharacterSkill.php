<?php

namespace App\Entity;

use App\Repository\CharacterSkillRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterSkillRepository::class)
 * @ORM\Table(name="character_skill_selected")
 */
class CharacterSkill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Character::class, inversedBy="characterSkills")
     */
    private $characterSheet;

    /**
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity=Skill::class, inversedBy="characterSkills")
     */
    private $skill;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

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
