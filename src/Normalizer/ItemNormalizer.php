<?php

namespace App\Normalizer;

use App\Entity\Item;
use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ItemNormalizer implements ContextAwareNormalizerInterface
{
    private NormalizerInterface $normalizer;

    private string $itemImagesUrl;

    /**
     * ItemNormalizer constructor.
     *
     * @param string $itemImagesUrl
     */
    public function __construct(string $itemImagesUrl)
    {
        $this->itemImagesUrl = $itemImagesUrl;
    }

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
        return $data instanceof Item && !str_contains($data->getImage(), $this->itemImagesUrl);
    }

    /**
     * @param Item $object
     * @param null $format
     * @param array $context
     *
     * @return array|\ArrayObject|bool|float|int|string|null
     *
     * @throws ExceptionInterface
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $object->setImage($this->itemImagesUrl . $object->getImage());
        return $this->normalizer->normalize($object, $format, $context);
    }
}