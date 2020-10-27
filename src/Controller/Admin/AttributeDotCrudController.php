<?php

namespace App\Controller\Admin;

use App\Entity\AttributeDot;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AttributeDotCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AttributeDot::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Pallini degli Attributi')
            ->setEntityLabelInSingular('Pallino di un Attributo')
            ->setPageTitle('index', 'Lista dei %entity_label_plural%')
            ->setDateFormat('d F Y')
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('effect')
            ->add('value')
            ->add('attribute')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('effect', 'Effetto'),
            IntegerField::new('value', '# Pallino'),
            AssociationField::new('attribute', 'Attributo')
        ];
    }
}
