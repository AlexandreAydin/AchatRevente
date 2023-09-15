<?php

namespace App\Form\Annonce\Vehicule;

use App\Entity\Annonce\Vehicule\Voitures;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoituresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('marque', ChoiceType::class, [
            'choices' => [
                'BMW' => 'bmw',
                'Mercedes' => 'mercedes',
            ],
            'placeholder' => 'Choisir une marque',
        ])
        ->add('model', ChoiceType::class, [
            'choices' => [
                'Serie 1' => 'serie1',
                'Serie 2' => 'serie2',
            ],
            'placeholder' => 'Choisir un modèle',
        ])
        ->add('annee', IntegerType::class)
        ->add('carburant', ChoiceType::class, [
            'choices' => [
                'Essence' => 'essence',
                'Diesel' => 'diesel',
            ],
            'placeholder' => 'Type de carburant',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voitures::class,
        ]);
    }
}
