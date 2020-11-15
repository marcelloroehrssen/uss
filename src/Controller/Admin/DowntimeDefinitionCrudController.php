<?php

namespace App\Controller\Admin;

use App\Entity\DowntimeDefinition;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DowntimeDefinitionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DowntimeDefinition::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Azioni in narrativa')
            ->setEntityLabelInSingular('Azione in narrativa')
            ->setPageTitle('index', 'Lista delle %entity_label_plural%')
            ->setDateFormat('d F Y')
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('challenge')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nome'),
            TextEditorField::new('description', 'Descrizione'),
            TextEditorField::new('note', 'Note'),
            IntegerField::new('challenge', 'Difficoltà'),
            AssociationField::new('items', 'Oggetti necessari'),
        ];
    }
}
