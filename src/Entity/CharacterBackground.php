<?php

namespace App\Entity;

use App\Repository\CharacterBackgroundRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterBackgroundRepository::class)
 */
class CharacterBackground
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Character::class, inversedBy="characterBackgrounds")
     */
    private $characterSheet;

    /**
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity=Background::class, inversedBy="characterBackgrounds")
     */
    private $background;

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
