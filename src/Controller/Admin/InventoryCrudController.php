<?php

namespace App\Controller\Admin;

use App\Entity\Inventory;
use App\Form\InventoryItemType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class InventoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Inventory::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Inventari')
            ->setEntityLabelInSingular('Inventario')
            ->setPageTitle('index', 'Lista degli %entity_label_plural%')
            ->setDateFormat('d F Y')
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('owner')
            ->add('label')
            ->add('entries')
            ->add('isPublic')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('owner', 'Proprietario'),
            TextField::new('label', 'Nome'),
            CollectionField::new('entries', 'Item')
                ->setEntryIsComplex(true)
                ->setEntryType(InventoryItemType::class),
            BooleanField::new('isPublic', 'Pubblica')
        ];
    }
}
