<?php

namespace App\Controller\Admin;

use App\Entity\Background;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BackgroundCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Background::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Backgound')
            ->setEntityLabelInSingular('Backgound')
            ->setPageTitle('index', 'Lista dei %entity_label_plural%')
            ->setDateFormat('d F Y')
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('count')
            ->add('dots')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nome'),
            IntegerField::new('count', 'Acquistabile')->setHelp('Numero massimo di volte per cui è acquistabile questo Background, 0 (zero) vuole dire illimitato'),
            TextEditorField::new('description', 'Descrizione')->hideOnIndex(),
            TextField::new('bonus', 'Bonus'),
            TextField::new('malus', 'Malus'),
            TextField::new('keep', 'Mantenimento'),
            TextEditorField::new('extra', 'Extra')->hideOnIndex(),
            TextEditorField::new('note', 'Note'),
            AssociationField::new('dots', 'Pallini'),
            ChoiceField::new('costType', 'Tipo di costo')->setChoices([
                'Normale' => 0,
                'Esponenziale' => 1,
                'x2' => 2,
                'x3' => 3
            ]),
        ];
    }
}
