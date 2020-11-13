<?php

namespace App\Converter;

use App\Entity\Character;
use App\Entity\CharacterAttribute;
use App\Entity\CharacterBackground;
use App\Entity\CharacterSkill;
use App\Entity\Inventory;
use App\Entity\InventoryEntry;
use App\Repository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class CharacterConverter implements ParamConverterInterface
{
    private Repository\CharacterRepository $characterRepository;
    private Repository\AttributeRepository $attributeRepository;
    private Repository\FaithRepository $faithRepository;
    private Repository\FactionRepository $factionRepository;
    private Repository\DefectRepository $defectRepository;
    private Repository\JobRepository $jobRepository;
    private Repository\SkillRepository $skillRepository;
    private Repository\BackgroundRepository $backgroundRepository;
    private Repository\ItemRepository $itemRepository;

    /**
     * CharacterConverter constructor.
     * @param Repository\CharacterRepository $characterRepository
     * @param Repository\AttributeRepository $attributeRepository
     * @param Repository\FaithRepository $faithRepository
     * @param Repository\FactionRepository $factionRepository
     * @param Repository\DefectRepository $defectRepository
     * @param Repository\JobRepository $jobRepository
     * @param Repository\SkillRepository $skillRepository
     * @param Repository\BackgroundRepository $backgroundRepository
     * @param Repository\ItemRepository $itemRepository
     */
    public function __construct(
        Repository\CharacterRepository $characterRepository,
        Repository\AttributeRepository $attributeRepository,
        Repository\FaithRepository $faithRepository,
        Repository\FactionRepository $factionRepository,
        Repository\DefectRepository $defectRepository,
        Repository\JobRepository $jobRepository,
        Repository\SkillRepository $skillRepository,
        Repository\BackgroundRepository $backgroundRepository,
        Repository\ItemRepository $itemRepository)
    {
        $this->characterRepository = $characterRepository;
        $this->attributeRepository = $attributeRepository;
        $this->faithRepository = $faithRepository;
        $this->factionRepository = $factionRepository;
        $this->defectRepository = $defectRepository;
        $this->jobRepository = $jobRepository;
        $this->skillRepository = $skillRepository;
        $this->backgroundRepository = $backgroundRepository;
        $this->itemRepository = $itemRepository;
    }


    public function apply(Request $request, ParamConverter $configuration)
    {
        $decoded = json_decode($request->getContent(), true);

        $character = new Character();
        $character->setMode($decoded['mode']);
        $character->setName($decoded['name']);
        $character->setFaith($this->faithRepository->findOneBy(['name' => $decoded['faith']]));

        $character->setFaction($this->factionRepository->findOneBy(['name' => $decoded['faction']]));
        $character->setFactionSkill($this->skillRepository->findOneBy(['name' => $decoded['factionSkill']]));

        foreach (['physical','mental','social'] as $attribute) {
            $characterAttribute = new CharacterAttribute();
            $characterAttribute->setAttribute(
                $this->attributeRepository->findOneBy(['externalId' => $attribute])
            );
            $characterAttribute->setValue($decoded['attributes'][$attribute]);

            $character->addCharacterAttribute($characterAttribute);
        }

        $character->setDefectMode($decoded['defectMode']);

        foreach ($decoded['defects'] as $defect) {
            $character->addDefect($this->defectRepository->findOneBy(['name' => $defect]));
        }

        $character->setJob($this->jobRepository->findOneBy(['name' => $decoded['job']]));

        foreach ($decoded['jobSkills'] as $jobSkill) {
            $character->addJobSkill($this->skillRepository->findOneBy(['name' => $jobSkill]));
        }

        foreach ($decoded['skills'] as $skillName => $value) {
            $skill = new CharacterSkill();
            $skill->setSkill($this->skillRepository->findOneBy(['name' => $skillName]));
            $skill->setValue($value);
            $character->addCharacterSkill($skill);
        }
        $character->setDiscardedSkill($this->skillRepository->findOneBy(['name' => $decoded['discardedSkill']]));

        foreach ($decoded['backgrounds'] as $backgroundName => $value) {
            $background = new CharacterBackground();
            $background->setBackground(
                $this->backgroundRepository->findOneBy(
                    ['name' => preg_replace('/_[0-9]+$/', '', $backgroundName)]
                )
            );
            $background->setValue($value);
            $character->addCharacterBackground($background);
        }

        $inventory = new Inventory();
        $inventory->setLabel('default');
        foreach ($decoded['items'] as $itemId => $quantity) {
            $inventoryEntry = new InventoryEntry();
            $inventoryEntry->setItem($this->itemRepository->find($itemId));
            $inventoryEntry->setQuantity($quantity);

            $inventory->addEntry($inventoryEntry);
        }
        $character->addInventory($inventory);

        $request->attributes->set($configuration->getName(), $character);

        return true;
    }

    public function supports(ParamConverter $configuration)
    {
        return $configuration->getClass() === Character::class && $configuration->getOptions()['from_json'];
    }
}