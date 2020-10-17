<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class SkillDot extends Dot
{
    /**
     * @ORM\ManyToOne(targetEntity=Skill::class, inversedBy="dot")
     * @ORM\JoinColumn(nullable=false, nullable=true)
     */
    private $skill;

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
