<?php

namespace App\Form;

use App\Entity\CharacterBackground;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterBackgroundType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('background', null, ['label' => 'Nome background'])
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CharacterBackground::class,
        ]);
    }
}
