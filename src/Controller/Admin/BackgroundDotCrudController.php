<?php

namespace App\Controller\Admin;

use App\Entity\BackgroundDot;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BackgroundDotCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BackgroundDot::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Pallini dei Background')
            ->setEntityLabelInSingular('Pallino di un Background')
            ->setPageTitle('index', 'Lista dei %entity_label_plural%')
            ->setDateFormat('d F Y')
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('effect')
            ->add('value')
            ->add('background')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('effect', 'Effetto'),
            IntegerField::new('value', '# Pallino'),
            AssociationField::new('background', 'Background')
        ];
    }
}
