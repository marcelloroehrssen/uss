<?php

namespace App\Controller\Admin;

use App\Entity\SkillDot;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
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

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Pallini delle Abilità')
            ->setEntityLabelInSingular('Pallino di un Abilità')
            ->setPageTitle('index', 'Lista dei %entity_label_plural%')
            ->setDateFormat('d F Y');
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('effect')
            ->add('value')
            ->add('skill');
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
