<?php

namespace App\Normalizer;

use App\Entity\JobType;

class JobTypeNormalizer extends AbstractMinimalNormalizer
{
    const TYPE_MINIMAL = 'minimal';

    protected $key = 'jobType';
    protected $method = 'getRequisite';

    protected function apply($data)
    {
        return $data instanceof JobType;
    }
}