<?php

namespace App\Form;

use App\Entity\InventoryEntry;
use App\Entity\Item;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\CrudAutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InventoryItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('item')
            ->add('quantity')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InventoryEntry::class,
        ]);
    }
}
