<?php

namespace App\Form\Annonce\Vehicule;

use App\Entity\Annonce\Vehicule\Camions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CamionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $years = range(2023, 1969); // Ceci créera un tableau avec des années allant de 2023 à 1970
        $choices = array_combine($years, $years) + ["1970 avant" => "1970 avant"] ;
        $builder
        ->add('annee', ChoiceType::class, [
            'choices' => 
                $choices,
            
            'placeholder' => 'Choisissez',
            'label' => 'Année modèle'
        ])
            ->add('mileage', TypeTextType::class,[
                'attr' => ['class' => 'form-control'],
                "label" => 'Kilométrage'
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Camions::class,
        ]);
    }
}
