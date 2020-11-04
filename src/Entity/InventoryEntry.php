<?php

namespace App\Entity;

use App\Repository\InventoryEntryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=InventoryEntryRepository::class)
 */
class InventoryEntry
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Item::class, inversedBy="inventoryEntries")
     * @Groups("exposed")
     */
    private $item;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("exposed")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Inventory::class, inversedBy="entries")
     */
    private $inventory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getInventory(): ?Inventory
    {
        return $this->inventory;
    }

    public function setInventory(?Inventory $inventory): self
    {
        $this->inventory = $inventory;

        return $this;
    }
}
