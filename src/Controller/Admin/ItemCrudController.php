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
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ItemCrudController extends AbstractCrudController
{
    private string $itemImagesPath;

    /**
     * ItemCrudController constructor.
     * @param string $itemImagesPath
     */
    public function __construct(string $itemImagesPath)
    {
        $this->itemImagesPath = $itemImagesPath;
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
                ->setBasePath($this->itemImagesPath),
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nome'),
            TextareaField::new('description', 'Descrizione'),
            IntegerField::new('cost', 'Costo'),
            BooleanField::new('isConsumable', 'Consumabile'),
            BooleanField::new('enabled', 'Abilitato'),
        ];
    }
}
