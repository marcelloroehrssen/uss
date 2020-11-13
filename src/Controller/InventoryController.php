<?php

namespace App\Controller;

use App\Repository\InventoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InventoryController extends AbstractController
{
    use CharacterAware;

    /**
     * @Route("/inventory", name="inventory")
     */
    public function read(InventoryRepository $inventoryRepository)
    {
        $inventories = $inventoryRepository->findBy([
            'owner' => $this->getCharacter()
        ]);

        return $this->json($inventories, 200, [], ['groups' => 'exposed']);
    }
}
