<?php

namespace App\Controller;

use App\Entity\Inventory;
use App\Entity\InventoryEntry;
use App\Entity\Item;
use App\Repository\InventoryEntryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class InventoryEntryController
 * @package App\Controller
 *
 * @Route("/inventory_entry")
 */
class InventoryEntryController extends AbstractController
{
    private InventoryEntryRepository $inventoryEntryRepository;
    private EntityManagerInterface $entityManager;

    /**
     * ItemController constructor.
     * @param InventoryEntryRepository $inventoryEntryRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(InventoryEntryRepository $inventoryEntryRepository, EntityManagerInterface $entityManager)
    {
        $this->inventoryEntryRepository = $inventoryEntryRepository;
        $this->entityManager = $entityManager;
    }
    /**
     * @Route(methods={"delete"}, name="item_remove")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        $id = $request->request->get('id');

        return $this->json(['id' => $id]);
    }

    /**
     * @Route("/struct", methods={"post"}, name="item_update_struct_point")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function use(Request $request)
    {
        $id = $request->request->get('id');
        $action = $request->request->get('action');

        /** @var InventoryEntry $entry */
        $entry = $this->inventoryEntryRepository->find($id);

        $st = $entry->getStructPoint();
        $points = $action === 'increment' ? ++$st : --$st;
        $points = $points < 0 ? 0 : $points;
        $points = $points > $entry->getItem()->getStructPoint() ? $entry->getItem()->getStructPoint() : $points;

        $entry->setStructPoint($points);

        $this->entityManager->flush();

        return $this->json(['points' => $points]);
    }
}