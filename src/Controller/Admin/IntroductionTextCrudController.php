<?php

namespace App\Controller\Admin;

use App\Entity\IntroductionText;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class IntroductionTextCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return IntroductionText::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Testi introduttivi')
            ->setEntityLabelInSingular('Testo introduttivo')
            ->setPageTitle('index', 'Lista dei %entity_label_plural%')
            ->setDateFormat('d F Y')
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('hook')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ChoiceField::new('hook', 'Dove vuoi mostrare questo testo?')->setChoices([
                'Nella home del sito' => 'home',
                'Nella pagina principale della creazione PG' => 'pg_creation_home',
                'Nella scelta della modalità di gioco' => 'mode',
                'Nella scelta dei difetti' => 'defects',
                'Nella scelta degli attributi' => 'attributes',
                'Nella scelta delle fedi' => 'faiths',
                'Nella scelta delle fazioni' => 'factions',
                'Nella scelta dei mestieri' => 'jobs',
                'Nella scelta delle abilità' => 'skills',
                'Nella scelta dei background' => 'background',
            ]),
            TextEditorField::new('Content', 'Contenuto'),
        ];
    }
}
