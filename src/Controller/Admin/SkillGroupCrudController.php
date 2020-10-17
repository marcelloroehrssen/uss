<?php

namespace App\Controller\Admin;

use App\Entity\SkillGroup;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SkillGroupCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SkillGroup::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Gruppi di Skill')
            ->setEntityLabelInSingular('Gruppo di Skill')
            ->setPageTitle('index', 'Lista dei %entity_label_plural%')
            ->setDateFormat('d F Y')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            IntegerField::new('count', 'Nome'),
            AssociationField::new('job', 'Mestiere'),
            AssociationField::new('skills', 'Abilità')
        ];
    }
}
