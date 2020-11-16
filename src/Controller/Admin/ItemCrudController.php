<?php

namespace App\Controller\Admin;

use App\Entity\Item;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ItemCrudController extends AbstractCrudController
{
    private string $itemImagesUrl;

    /**
     * ItemCrudController constructor.
     * @param string $itemImagesUrl
     */
    public function __construct(string $itemImagesUrl)
    {
        $this->itemImagesUrl = $itemImagesUrl;
    }

    public static function getEntityFqcn(): string
    {
        return Item::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Oggetti')
            ->setEntityLabelInSingular('Oggetto')
            ->setPageTitle('index', 'Lista degli %entity_label_plural%')
            ->setDateFormat('d F Y')
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('type')
            ->add('macroCategory')
            ->add('value')
            ->add('dots')
            ->add('bonus')
            ->add('structPoint')
            ->add('description')
            ->add('isConsumable')
            ->add('onlyInCreation')
            ->add('enabled')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('imageFile', 'Immagine')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),
            ImageField::new('image', 'Immagine')
                ->onlyOnIndex()
                ->setBasePath($this->itemImagesUrl),
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nome'),
            ChoiceField::new('type', 'Tipologia')->setChoices(Item::TYPES),
            ChoiceField::new('macroCategory', 'Macrocategoria')->setChoices(Item::MACRO_TYPES),
            TextEditorField::new('description', 'Descrizione')->onlyOnForms(),
            IntegerField::new('dots', 'Pallini')->setFormTypeOption('attr', ['min' => 0, 'max' => 3]),
            IntegerField::new('structPoint', 'Punti usura massimi'),
            IntegerField::new('bonus', 'Bonus alle azioni')
                ->setHelp('Il bonus sarà automaticamente applicato ai tiri di risoluzione delle azioni'),
            IntegerField::new('value', 'Punti oggetto'),
            IntegerField::new('max', 'Massimo')
                ->setHelp('Numero di volte in cui questo oggetto è acquistabile in creazione'),
            IntegerField::new('cost', 'Costo di acquisto')
                ->setHelp('Numero di volte in cui questo oggetto è acquistabile in creazione')
				->onlyOnForms(),
            IntegerField::new('costSell', 'Costo di vendita')
                ->setHelp('Numero di volte in cui questo oggetto è acquistabile in creazione')
				->onlyOnForms(),
            BooleanField::new('isConsumable', 'Consumabile'),
            BooleanField::new('onlyInCreation', 'Solo in creazione')->setHelp('Questo item è disponibile in creazione'),
            BooleanField::new('enabled', 'Abilitato'),
        ];
    }
}
