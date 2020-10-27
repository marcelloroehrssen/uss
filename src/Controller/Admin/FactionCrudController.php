<?php

namespace App\Controller\Admin;

use App\Entity\Faction;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FactionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Faction::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Fazioni')
            ->setEntityLabelInSingular('Fazione')
            ->setPageTitle('index', 'Lista delle %entity_label_plural%')
            ->setDateFormat('d F Y')
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('type')
            ->add('visibility')
            ->add('skills')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nome'),
            ChoiceField::new('type', 'Tipo')->setChoices([
                'Aperta' => 'open', 'Chiusa' => 'closed'
            ]),
            ChoiceField::new('visibility', 'Visibilità')->setChoices([
                'Nascosta' => 'hidden', 'Visibile' => 'visible'
            ]),
            TextareaField::new('description', 'Descrizione'),
            AssociationField::new('skills', 'Abilità')->formatValue(function ($value, $entity) {
                return implode(', ', $entity->getSkills()->map(fn ($e) => $e->getName())->toArray());
            }),
        ];
    }
}
