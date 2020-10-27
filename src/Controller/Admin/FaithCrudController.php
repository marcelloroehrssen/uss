<?php

namespace App\Controller\Admin;

use App\Entity\Faith;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FaithCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Faith::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Fedi')
            ->setEntityLabelInSingular('Fede')
            ->setPageTitle('index', 'Lista delle %entity_label_plural% disponibili')
            ->setDateFormat('d F Y')
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('enabled')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nome'),
            TextareaField::new('description', 'Descrizione'),
            IntegerField::new('limitWife', 'Limite Marito/Mogli')->setHelp('0 implica infiniti/e Marito/Mogli'),
            BooleanField::new('enabled', 'Abilitata'),
        ];
    }
}
