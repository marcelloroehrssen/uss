<?php

namespace App\Controller\Admin;

use App\Entity\SkillDot;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SkillDotCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SkillDot::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('effect', 'Effetto'),
            IntegerField::new('value', '# Pallino'),
            AssociationField::new('skill', 'Abilità')
        ];
    }
}
