<?php

namespace App\Normalizer;

use App\Entity\Skill;

class SkillNormalizer extends AbstractMinimalNormalizer
{
    const TYPE_MINIMAL = 'minimal';

    protected $key = 'skill';
    protected $method = 'getName';

    protected function apply($data)
    {
        return $data instanceof Skill;
    }
}