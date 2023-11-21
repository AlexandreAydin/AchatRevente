<?php

namespace App\Form\Annonce\Immobilier;

use App\Entity\Annonce\Immobilier\LandForSale;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LandForSaleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('buildingLand',ChoiceType::class,[
                'choices' => [
                    'oui' => 'oui',
                    'non' => 'non',
                ],
                'placeholder' => 'Choisissez',
                'label' => 'Terrain Constructible ? '
            ] )
            ->add('livingArea',TextType::class,[
                'label' => 'Surface habitable',
            ] )
            ->add('surfaceArea',TextType::class,[
                'label' => 'Surface total du terrain',
            ] );
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LandForSale::class,
        ]);
    }
}
