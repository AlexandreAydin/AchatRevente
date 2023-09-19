<?php

namespace App\Form\Annonce\Vehicule;

use App\Entity\Annonce\Vehicule\Motos;
use App\Entity\Annonce\Vehicule\Motos\MakeOfMoto;
use App\Entity\Annonce\Vehicule\Motos\MotoModel;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MotosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $years = range(2023, 1969); // Ceci créera un tableau avec des années allant de 2023 à 1970
        $choices = array_combine($years, $years) + ["1970 avant" => "1970 avant"] ;
        $builder
        ->add('makeOfMoto', EntityType::class, [
            'class' => MakeOfMoto::class,
            'choice_label' => 'name',
            'placeholder' => 'Sélectionnez la marque du véhicule',
            'label' => 'Marque'
        ])
        ->add('motoModel', EntityType::class, [
            'class' => MotoModel::class,
            'choice_label' => 'name',
            'placeholder' => 'Sélectionnez la modéle de véhicule',
            'label' => 'Modèle'
        ])
        ->add('annee', ChoiceType::class, [
            'choices' => 
                $choices,
            
            'placeholder' => 'Choisissez',
            'label' => 'Année modèle'
        ])
        ->add('type',ChoiceType::class,[
            'choices' => [
                '4x4 SUV & Crossver'=>'4x4 SUV & Crossver',
                'Citadine' => 'Citadine',
                'Berlin' => 'Berlin',
                'Break' =>  'Break',
                'Cabriolet' => 'Cabriolet',
                'Coupé' => 'Coupé',
                'Monospace' => 'Monospace',
                'Bus & Minibus' => 'Bus & Minibus',
                'Pick-up' => 'Pick-up',
                'Voiture société & commerciale'=> 'Voiture société & commerciale',
                'Autre' => "Autre"
            ],
            'label' => 'Type de véhicule',
            'placeholder' => 'Choisissez',
        ])
        ->add('driverLicense', ChoiceType::class, [
            'choices' => [
                'Avec Permis' => 'Avec permis',
                'Sans Permis' => 'Sans permis',
            ],
            'expanded' => true,
            "label" => 'Permis'
        ])
        ->add('mileage', TypeTextType::class,[
            'attr' => ['class' => 'form-control'],
            "label" => 'Kilométrage'
        ])
        ->add('color', ChoiceType::class,[
            'choices' => [
                'Argent'   => 'Argent',
                'Beige'    => 'Beige',
                'Blanc'    => 'Blanc',
                'Bleu'     => 'Bleu',
                'Bordeaux' => 'Bordeaux',
                'Gris'     => 'Gris',
                'Ivoire'   => 'Ivoire',
                'Jaune'    => 'Jaune',
                'Marron'   => 'Marron',
                'Noir'     => 'Noir',
                'Orange'   => 'Orange',
                'Rose'     => 'Rose',
                'Rouge'    => 'Rouge',
                'Vert'     => 'Vert',
                'Violet'   => 'Violet',
                'Autre'    => 'Autre',
            ],
            'placeholder' => 'Choisissez',
            'label' => 'Couleur',      
        ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Motos::class,
        ]);
    }
}
