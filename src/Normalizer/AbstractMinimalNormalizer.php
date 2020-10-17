<?php

namespace App\Normalizer;

use App\Entity\Dot;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

abstract class AbstractMinimalNormalizer implements ContextAwareNormalizerInterface
{
    const TYPE_MINIMAL = 'minimal';

    /** @var string */
    protected $key;

    /** @var string */
    protected $method;

    abstract protected function apply($data);

    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return isset($context[$this->key]) && $context[$this->key] === self::TYPE_MINIMAL && $this->apply($data);
    }

    /**
     * @param Dot $object
     * @param null $format
     * @param array $context
     * @return array|\ArrayObject|bool|float|int|string|void|null
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return $object->{$this->method}();
    }
}