<?php

namespace App\Form;

use App\Entity\Annonce\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('categories',EntityType::class,[
                'class'=>Categorie::class,
                'label'=> false,
                'required'=> false,
                'multiple'=>true,
                'expanded' => true,
                'attr' => [
                    'class' => 'js-categories-multiple'
                ]
            
            ])
            ->add('minPrice', IntegerType::class,[
                'required'=> false,
                'label'=> false,
                'attr'=>[
                    'placeholder'=>'min...'
                ]
            ])
            ->add('maxPrice', IntegerType::class,[
                'required'=> false,
                'label'=> false,
                'attr'=>[
                    'placeholder'=>'max...'
                ]
            ])
            ->add('minMileage', IntegerType::class,[
                'required'=> false,
                'label'=> false,
                'attr'=>[
                    'placeholder'=>'min...'
                ]
            ])
            ->add('maxMileage', IntegerType::class,[
                'required'=> false,
                'label'=> false,
                'attr'=>[
                    'placeholder'=>'max...'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
