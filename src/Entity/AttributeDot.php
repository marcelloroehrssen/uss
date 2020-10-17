<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class AttributeDot extends Dot
{
    /**
     * @ORM\ManyToOne(targetEntity=Attribute::class, inversedBy="dots")
     * @ORM\JoinColumn(nullable=false, nullable=true)
     */
    private $attribute;

    public function getAttribute(): ?Attribute
    {
        return $this->attribute;
    }

    public function setAttribute(?Attribute $attribute): self
    {
        $this->attribute = $attribute;

        return $this;
    }
}
