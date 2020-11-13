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
            ->add('value')
            ->add('dots')
            ->add('description')
            ->add('cost')
            ->add('isConsumable')
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
            TextEditorField::new('description', 'Descrizione'),
            IntegerField::new('cost', 'Costo'),
            IntegerField::new('dots', 'Pallini'),
            IntegerField::new('value', 'Punti oggetto'),
            IntegerField::new('max', 'Massimo')->setHelp('Numero di volte in cui questo oggetto è acquistabile in creazione'),
            BooleanField::new('isConsumable', 'Consumabile'),
            BooleanField::new('enabled', 'Abilitato'),
        ];
    }
}
