<?php

namespace App\Form\Annonce\Immobilier;

use App\Entity\Annonce\Immobilier\ApartementRental;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApartementRentalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('livingArea',TextType::class,[
                'label' => 'Surface habitable',
            ] )
            ->add('numberOfParts',TextType::class,[
                'label' => 'Nombre de piéce',
            ] )
            ->add('Floor',TextType::class,[
                'label' => 'Étage',
            ])
            ->add('FloorsBuilding',TextType::class,[
                'label' => 'Étage de l\'immeuble',
            ])
            ->add('ageOfBuilding',TextType::class,[
                'label' => 'Âge de l\'immeuble',
            ])
            // ->add('exterior', ChoiceType::class, [
            //     'choices' => [
            //         'Balcon' => 'Balcon',
            //         'Terasse' => 'Terasse',
            //         'Jardin' => 'Jardin',
            //         'Piscine'=> 'Piscine',
            //         'Autre' => 'Autre'
            //     ],
            //     'expanded' => false,
            //     'multiple' => true,
            //     'label' => 'Extérieur',
            //     'placeholder' => 'Choisissez une option',
            //     'attr' => ['class' => 'select2-enable']
            // ])
            
            ->add('parkingSpace',ChoiceType::class,[
                'choices' => [
                    '1' => '1',
                    '2' => '2',
                    '3 ou plus' => '3',
                ],
                'placeholder' => 'Choisissez',
                'label' => 'Place de parking'
            ])
            ->add('elevator',ChoiceType::class,[
                'choices' =>[
                    'oui' => 'oui',
                    'non' => 'non',
                ],
                'placeholder' => 'Choisissez',
                'label' => 'Ascenseur'
            ])
            ->add('isFurnished',ChoiceType::class,[
                'choices' =>[
                    'oui' => 'oui',
                    'non' => 'non',
                ],
                'placeholder' => 'Choisissez',
                'label' => 'Appartement est Meublé ?'
            ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ApartementRental::class,
        ]);
    }
}
