<?php

namespace App\Normalizer;

use App\Entity\Character;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class CharacterNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return $data instanceof Character;
    }

    /**
     * @param Character $object
     * @param string $format
     * @param array $context
     * @return array|\ArrayObject|bool|float|int|string|void|null
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $attributes = [];
        foreach ($object->getCharacterAttributes() as $characterAttribute) {
            $attributes[$characterAttribute->getAttribute()->getExternalId()] = $characterAttribute->getValue();
        }

        $defects = [];
        foreach ($object->getDefects() as $characterDefects) {
            $defects[] = $characterDefects->getName();
        }
        ksort($defects);

        $jobSkills = [];
        foreach ($object->getJobSkills() as $characterJobSkill) {
            $jobSkills[] = $characterJobSkill->getName();
        }
        ksort($jobSkills);

        $skills = [];
        foreach ($object->getCharacterSkills() as $characterSkill) {
            $skills[$characterSkill->getSkill()->getName()] = $characterSkill->getValue();
        }
        ksort($skills);

        $backgrounds = [];
        foreach ($object->getCharacterBackgrounds() as $characterBackground) {
            $i = 0;
            do {
                $key = $characterBackground->getBackground()->getName() . '_' . $i++;
            } while (array_key_exists($key, $backgrounds));

            $backgrounds[$key] = $characterBackground->getValue();
        }
        ksort($backgrounds);

        return [
            'enabled' => $object->getEnabled(),
            'creationTime' => $object->getCreationDate()->format('Y-m-d H:i:s'),
            'mode' => $object->getMode(),
            'name' => $object->getName(),
            'faith' => $object->getFaith()->getName(),
            'faction' => $object->getFaction()->getName(),
            'attributes' => $attributes,
            'defectMode' => $object->getDefectMode(),
            'defects' => $defects,
            'job' => $object->getJob()->getName(),
            'jobSkills' => $jobSkills,
            'factionSkill' => $object->getFactionSkill()->getName(),
            'skills' => $skills,
            'discardedSkill' => $object->getDiscardedSkill()->getName(),
            'backgrounds' => $backgrounds
        ];
    }
}