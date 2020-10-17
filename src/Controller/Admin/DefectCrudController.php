<?php

namespace App\Controller\Admin;

use App\Entity\Defect;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DefectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Defect::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Difetti')
            ->setEntityLabelInSingular('Difetto')
            ->setPageTitle('index', 'Lista dei %entity_label_plural%')
            ->setDateFormat('d F Y')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nome'),
            IntegerField::new('cost', 'Punti BG'),
            TextareaField::new('description', 'Descrizione'),
        ];
    }
}
