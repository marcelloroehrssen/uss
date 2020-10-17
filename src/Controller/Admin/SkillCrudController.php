<?php

namespace App\Controller\Admin;

use App\Entity\Skill;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SkillCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Skill::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Abilità')
            ->setEntityLabelInSingular('Abilità')
            ->setPageTitle('index', 'Lista delle %entity_label_plural%')
            ->setDateFormat('d F Y')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nome'),
            TextEditorField::new('description1', 'Descrizione primaria'),
            AssociationField::new('dots', 'Pallini'),
            TextEditorField::new('description2', 'Descrizione secondaria'),
            TextEditorField::new('note', 'Note')
        ];
    }
}
