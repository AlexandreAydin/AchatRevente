<?php

namespace App\Form\Annonce\Vehicule;

use App\Entity\Annonce\Vehicule\Voitures;
use App\Entity\Annonce\Vehicule\Voitures\CarModel;
use App\Entity\Annonce\Vehicule\Voitures\MakeOfCar as VoituresMakeOfCar;
use PhpParser\Parser\Multiple;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoituresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $years = range(2023, 1969); // Ceci créera un tableau avec des années allant de 2023 à 1970
        $choices = array_combine($years, $years) + ["1970 avant" => "1970 avant"] ;
        $builder
        ->add('makeOfCar', EntityType::class, [
            'class' => VoituresMakeOfCar::class,
            'choice_label' => 'name',
            'placeholder' => 'Sélectionnez la marque du véhicule',
            'label' => 'Marque'
        ])
        ->add('carModel', EntityType::class, [
            'class' => CarModel::class,
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
        ->add('carburant', ChoiceType::class, [
            'choices' => [
                'Essence' => 'essence',
                'Diesel' => 'diesel',
                'Hybride' => 'hybride',
                'Electrique'=> 'electrique',
                'Autre' => 'Autre'
            ],
            'placeholder' => 'Choisissez',
            'label' => 'Carburant'
        ])
        ->add('gearbox', ChoiceType::class, [
            'choices' => [
                'Manuelle' => 'manuelle',
                'Automatique' => 'automatique',
                'Semi-automatique' => 'semi-automatique',
            ],
            'expanded' => true,
            'label' => 'Boîte de vitesse'
        ])
        ->add('vehicleType',ChoiceType::class,[
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
        ->add('numberOfSeats',ChoiceType::class,[
            'choices' => [
                '2'=>'2',
                '3'=>'3',
                '4'=>'4',
                '5'=>'5',
                '6 plus'=>'6 plus'
            ],
            'label' => 'Nombre de portes',
            'placeholder' => 'Choisissez',
        ])
        ->add('numberOfPlaces',ChoiceType::class,[
            'choices' => [
                '2'=>'2',
                '3'=>'3',
                '4'=>'4',
                '5'=>'5',
                '6'=>'6',
                '7 plus'=>'7 plus'
            ],
            'label' => 'Nombre de places',
            'placeholder' => 'Choisissez',
        ])
        ->add('fiscalPower', TypeTextType::class,[
            'attr' => ['class' => 'form-control'],
            'label' => 'Puissance fiscale'
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
            'data_class' => Voitures::class,
        ]);
    }
}
