<?php

namespace App\Controller;

use App\Repository\CharacterRepository;
use App\Repository\InventoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;

class InventoryController extends AbstractController
{
    /**
     * @Route("/inventories", name="inventory")
     */
    public function read(InventoryRepository $inventoryRepository, CharacterRepository $characterRepository)
    {
        $character = $characterRepository->findOneBy([
            'user' => $this->getUser(),
            'enabled' => true
        ]);
        $inventories = $inventoryRepository->findBy([
            'owner' => $character
        ]);

        return $this->json($inventories, 200, [], ['groups' => 'exposed']);
    }
}
