<?php

namespace App\Form;

use App\Entity\CharacterAttribute;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterAttributeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('attribute', null, ['label' => 'Nome'])
            ->add('value', ChoiceType::class, [
                'label' => 'Valore',
                'choices' => [
                    '1 - o' => 1,
                    '2 - oo' => 2,
                    '3 - ooo' => 3,
                    '4 - oooo' => 4,
                    '5 - ooooo' => 5,
                ]
            ])
//            ->add('characterSheet')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CharacterAttribute::class,
        ]);
    }
}
