<?php

namespace App\Normalizer;

use App\Entity\Dot;

class DotNormalizer extends AbstractMinimalNormalizer
{
    protected $key = 'dots';
    protected $method = 'getEffect';

    public function apply($data)
    {
        return $data instanceof Dot;
    }
}