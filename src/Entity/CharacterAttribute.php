<?php

namespace App\Entity;

use App\Repository\CharacterAttributeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterAttributeRepository::class)
 */
class CharacterAttribute
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $value = 1;

    /**
     * @ORM\ManyToOne(targetEntity=Attribute::class, fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $attribute;

    /**
     * @ORM\ManyToOne(targetEntity=Character::class, inversedBy="characterAttributes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $characterSheet;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAttribute(): ?Attribute
    {
        return $this->attribute;
    }

    public function setAttribute(?Attribute $attribute): self
    {
        $this->attribute = $attribute;

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

    public function __toString()
    {
        return $this->attribute->getName(). ': '. $this->value;
    }
}
