<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class BackgroundDot extends Dot
{
    /**
     * @ORM\ManyToOne(targetEntity=Background::class, inversedBy="dot")
     */
    private $background;

    public function getBackground(): ?Background
    {
        return $this->background;
    }

    public function setBackground(?Background $background): self
    {
        $this->background = $background;

        return $this;
    }
}
