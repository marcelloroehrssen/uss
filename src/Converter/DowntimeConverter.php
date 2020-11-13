<?php

namespace App\Converter;

use App\Controller\CharacterAware;
use App\Entity\Character;
use App\Entity\CharacterAttribute;
use App\Entity\CharacterBackground;
use App\Entity\CharacterSkill;
use App\Entity\Downtime;
use App\Entity\InventoryEntry;
use App\Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class DowntimeConverter implements ParamConverterInterface
{
    use CharacterAware;

    private Security $security;
    private Repository\DowntimeRepository $downtimeRepository;
    private Repository\DowntimeDefinitionRepository $downtimeDefinitionRepository;
    private Repository\ItemRepository $itemRepository;

    /**
     * DowntimeConverter constructor.
     *
     * @param Security $security
     * @param Repository\DowntimeRepository $downtimeRepository,
     * @param Repository\DowntimeDefinitionRepository $downtimeDefinitionRepository
     * @param Repository\ItemRepository $itemRepository
     */
    public function __construct(
        Security $security,
        Repository\DowntimeRepository $downtimeRepository,
        Repository\DowntimeDefinitionRepository $downtimeDefinitionRepository,
        Repository\ItemRepository $itemRepository)
    {
        $this->downtimeRepository = $downtimeRepository;
        $this->security = $security;
        $this->downtimeDefinitionRepository = $downtimeDefinitionRepository;
        $this->itemRepository = $itemRepository;
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        $decoded = json_decode($request->getContent(), true);

        $character = $this->getCharacter();

        if (null !== $decoded['id']) {
            $downtime = $this->downtimeRepository->find($decoded['id']);
        } else {
            $downtime = new Downtime();
        }

        $downtime->setCharacterSheet($character);
        $downtime->setName($decoded['name']);
        $downtime->setDescription($decoded['description']);
        $downtime->setCreatedAt(new \DateTime());
        $downtime->setDownTimeDefinition(
            $this->downtimeDefinitionRepository->findOneBy([
                'name' => $decoded['downTimeDefinition']['name']
            ])
        );
        /** @var PersistentCollection $inventoryEntries */
        $inventoryEntries = $character->getInventories()->get(0)->getEntries();
        $entries = new ArrayCollection();
        foreach ($decoded['relatedItems'] as $relatedItems) {
            /** @var InventoryEntry $entry */
            $entry = $inventoryEntries->filter(function (InventoryEntry $i) use ($relatedItems) {
                return $i->getItem()->getName() === $relatedItems['item']['name'];
            })[0] ?? null;
            if (null !== $entry) {
                $entry->setDowntime($downtime);
                $entries->add($entry);
            }
        }
        $downtime->setRelatedItems($entries);

        $request->attributes->set($configuration->getName(), $downtime);

        return true;
    }

    public function getUser()
    {
        return $this->security->getUser();
    }

    public function supports(ParamConverter $configuration)
    {
        return $configuration->getClass() === Downtime::class && $configuration->getOptions()['from_json'];
    }
}