<?php

namespace App\Controller\Admin;

use App\Entity\Downtime;
use App\Entity\Inventory;
use App\Entity\InventoryEntry;
use App\Entity\Item;
use App\Entity\Recipe;
use App\Repository\InventoryEntryRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Provider\AdminContextProvider;
use Symfony\Component\Form\FormInterface;

class DowntimeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Downtime::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Azioni in narrativa')
            ->setEntityLabelInSingular('Azione in narrativa')
            ->setPageTitle('index', 'Lista delle %entity_label_plural%')
            ->setDateFormat('d F Y')
            ->setSearchFields(['storyTeller','createdAt'])
            ;
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets->addCssFile('css/downtime.css')
            ->addCssFile('css/comment.css');
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('createdAt')
            ->add('characterSheet')
            ->add('relatedItems')
            ->add('recipe')
            ->add('resolutionTime')
            ->add('storyTeller')
            ->add('resolution')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        $downtime = $this->getEntityDto();

        $stQb = function (UserRepository $userRepository) {
            $userRepository->findBy([
                'roles' => 'ROLE_ADMIN'
            ]);
        };

        if (Crud::PAGE_NEW !== $pageName) {
            $qb = function (InventoryEntryRepository $repository) use ($downtime) {
                return $repository->createQueryBuilder('i')
                    ->where('i.inventory in (:inventories)')
                    ->setParameter('inventories', $downtime->getCharacterSheet()->getInventories());
            };
            $help = 'Non cambiare questo valore se ci sono degli ITEM associati ad esso, potresti creare discrepanze';
        } else {
            $qb = function (InventoryEntryRepository $repository) {
                return $repository->createQueryBuilder('i');
            };
            $help = '';
        }

        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('createdAt', 'Data di creazione'),
            TextField::new('name', 'Titolo'),
            TextareaField::new('description', 'Description'),
            AssociationField::new('characterSheet', 'Personaggio')
                ->setHelp($help),
            AssociationField::new('relatedItems', 'Item associati')
                ->setFormTypeOption('query_builder', $qb)
                ->onlyWhenUpdating(),
            AssociationField::new('recipe', 'Ricetta associata')
                ->formatValue(fn (string $s, Downtime $d) => $d->getRecipe()->getDowntimeDefinition()->getName() . ' [' . $d->getRecipe()->getName() . ']'),
            TextEditorField::new('resolution', 'Risoluzione')->setNumOfRows(7),
            DateTimeField::new('resolutionTime', 'Data di risoluzione'),
            AssociationField::new('storyTeller', 'Narratore')
                ->setFormTypeOption('query_builder', $stQb),
        ];
    }

    /**
     * @return Downtime
     */
    public function getEntityDto()
    {
        /** @var AdminContext $context */
        $context = $this->get(AdminContextProvider::class)->getContext();
        return $context->getEntity()->getInstance();
    }
}
