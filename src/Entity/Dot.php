<?php

namespace App\Entity;

use App\Repository\DotRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=DotRepository::class)
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *     "attribute" = "AttributeDot",
 *     "skill"     = "SkillDot",
 *     "background"     = "BackgroundDot",
 * })
 */
abstract class Dot
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     * @Groups("exposed")
     */
    protected $effect;

    /**
     * @ORM\Column(type="integer")
     * @Groups("exposed")
     */
    protected $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEffect(): ?string
    {
        return $this->effect;
    }

    public function setEffect(string $effect): self
    {
        $this->effect = $effect;

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

    public function __toString()
    {
        return $this->getValue() . ' - ' . $this->getEffect();
    }
}
