<?php

namespace App\Form\Annonce\MultiMedia;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsoleAndGamesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('typeConsole', ChoiceType::class, [
            'choices' => [
                'PS4' => 'ps4',
                'PS5' => 'ps5',
                'Xbox' => 'xbox',
                'X360' => 'x360'
            ],
            'placeholder' => 'Choisir une console',
        ])
        ->add('etat', ChoiceType::class, [
            'choices' => [
                'Neuf' => 'neuf',
                'Comme neuf' => 'comme_neuf',
                'Abimé' => 'abime'
            ],
            'placeholder' => 'Choisir un état',
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => \App\Entity\Annonce\MultiMedia\ConsoleAndGames::class,
        ]);
    }
}
