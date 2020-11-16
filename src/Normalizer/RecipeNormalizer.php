<?php

namespace App\Normalizer;

use App\Entity\Recipe;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class RecipeNormalizer implements ContextAwareNormalizerInterface
{
    private NormalizerInterface $normalizer;

    /**
     * @required
     * @param NormalizerInterface $normalizer
     */
    public function setNormalizer(NormalizerInterface $normalizer): void
    {
        $this->normalizer = $normalizer;
    }

    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return $data instanceof Recipe;
    }

    /**
     * @param Recipe $object
     * @param null $format
     * @param array $context
     *
     * @return array|\ArrayObject|bool|float|int|string|null
     *
     * @throws ExceptionInterface
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'items' => $this->normalizer->normalize($object->getItems(), $format, $context),
        ];

        if (isset($context['include_definition']) && $context['include_definition']) {
            $data['downtimeDefinition'] = $this->normalizer->normalize($object->getDowntimeDefinition(), $format, $context);
        }

        return $data;
    }
}