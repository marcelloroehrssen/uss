<?php

namespace App\Controller\Admin;

use App\Entity\JobType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JobTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobType::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Tipologie di mestiere')
            ->setEntityLabelInSingular('Tipologia di mestiere')
            ->setPageTitle('index', 'Lista delle %entity_label_plural%')
            ->setDateFormat('d F Y')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('label', 'Nome'),
            IntegerField::new('requisite', 'Requisito minimo di attributo mentale'),
        ];
    }
}
