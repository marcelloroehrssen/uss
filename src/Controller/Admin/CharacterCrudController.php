<?php

namespace App\Controller\Admin;

use App\Entity\Character;
use App\Form\CharacterAttributeType;
use App\Form\CharacterBackgroundType;
use App\Form\CharacterSkillType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CharacterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Character::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Personaggi')
            ->setEntityLabelInSingular('Personaggio')
            ->setPageTitle('index', 'Lista degli %entity_label_plural%')
            ->setDateFormat('d F Y');
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('enabled')
            ->add('type')
            ->add('user')
            ->add('name')
            ->add('faith')
            ->add('faction')
            ->add('job')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            AssociationField::new('user', 'Utente'),
            BooleanField::new('enabled', 'Abilitato')
                ->setHelp('Il personaggio sarà disponibile solo se abilitato da un narratore'),
            ChoiceField::new('type', 'Tipo')
                ->setChoices(['PG' => 0, 'PNG' => 1]),
            DateTimeField::new('creationDate', 'Data di creazione')->hideOnForm(),
            DateTimeField::new('modificationDate', 'Ultima modifica')->hideOnForm(),

            FormField::addPanel('Info base'),
            ChoiceField::new('mode', 'Modalità di gioco')
                ->setChoices(['Softcore' => 1, 'Hardcore' => 2])->hideOnIndex(),
            TextField::new('name', 'Nome'),
            CollectionField::new('characterAttributes', 'Attributi')
                ->allowDelete(Crud::PAGE_NEW === $pageName)
                ->allowAdd(Crud::PAGE_NEW === $pageName)
                ->setEntryIsComplex(true)
                ->setEntryType(CharacterAttributeType::class)
                ->hideOnIndex(),

            FormField::addPanel('Fede'),
            AssociationField::new('faith', 'Fede'),

            FormField::addPanel('Fazione'),
            AssociationField::new('faction', 'Fazione'),
            AssociationField::new('factionSkill', 'Abilità di fazione')->hideOnIndex(),

            FormField::addPanel('Difetti'),
            AssociationField::new('defects', 'Difetti')->hideOnIndex(),
            ChoiceField::new('defectMode', 'Modalità difetti')
                ->setChoices(['Casuale' => 1, 'Non Casuale' => 2])->hideOnIndex(),

            FormField::addPanel('Mestiere'),
            AssociationField::new('job', 'Mestiere'),
            AssociationField::new('jobSkills', 'Abilità di mestiere')->hideOnIndex(),

            FormField::addPanel('Abilità'),
            CollectionField::new('characterSkills', 'Abilità')
                ->allowDelete(true)
                ->allowAdd(true)
                ->setEntryIsComplex(true)
                ->setEntryType(CharacterSkillType::class)
                ->hideOnIndex(),
            AssociationField::new('discardedSkill', 'Abilità scartata')
                ->setHelp('L\'abilità scartata può derivare da quella di fazione (qualora si sia deciso di sostituire una abilità di mestiere)')
                ->hideOnIndex(),

            FormField::addPanel('Background'),
            CollectionField::new('characterBackgrounds', 'Background')
                ->allowDelete(true)
                ->allowAdd(true)
                ->setEntryIsComplex(true)
                ->setEntryType(CharacterBackgroundType::class)
                ->hideOnIndex(),
        ];
    }
}
