<?php

namespace App\Form\Annonce;

use App\Entity\Annonce\Article;
use App\Entity\Annonce\Categorie;
use App\Entity\Annonce\Immobilier\ApartementForSale;
use App\Entity\Annonce\Immobilier\Categorie as ImmobilierCategorie;
use App\Entity\Annonce\Immobilier\HouseForSale;
use App\Entity\Annonce\SubCategorie;
use App\Form\Annonce\Immobilier\ApartementForSaleType;
use App\Form\Annonce\Immobilier\ApartementRentalType;
use App\Form\Annonce\Immobilier\HouseForSaleType;
use App\Form\Annonce\Immobilier\HouseRentalType;
use App\Form\Annonce\Immobilier\LandForSaleType;
use App\Form\Annonce\Vehicule\CamionsType;
use App\Form\Annonce\Vehicule\CaravanningType;
use App\Form\Annonce\Vehicule\MotosType;
use App\Form\Annonce\Vehicule\VoituresType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;


class ArticleType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
        ->add('title', TextType::class,[
            'attr' => ['class' => 'form-control'],
        ])
        ->add('description', TextareaType::class,[
            'attr' => ['class' => 'form-control'],
            'label' => "description",
            'label_attr' => ['class' => 'form-label mt-4']
        ])
        ->add('price', MoneyType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'required' => false,
            'label' => 'Prix ',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ]
        ])
        ->add('isPublic', CheckboxType::class, [
            'attr' => [
                'class' => 'form-check-input',
            ],
            'required' => false,
            'label' => 'Publier l\'annonce ? ',
            'label_attr' => [
                'class' => 'form-check-label'
            ],
        ])
        ->add('postCode', TextType::class, [
            'label' => 'Votre code postal',
            'attr' => [
                'placeholder' => 'Entrez votre code postal'
            ]
        ])
        ->add('city', TextType::class, [
            'label' => 'Ville',
            'attr' => [
                'placeholder' => 'Entrez votre ville'
            ]
        ])
        ->add('images', FileType::class, [
            'label' => false,
            'multiple' => true,
            'mapped' => false,
            'required' => false,
            'constraints' => [
                new All(
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file (JPEG or PNG)',
                    ])
                )
            ]
        ])
        ->add('categorie', EntityType::class, [
            'class' => Categorie::class,
            'choice_label' => 'name',
            'placeholder' => 'Sélectionnez votre Catégorie',
        ])
        ->add('subCategorie', EntityType::class, [
            'class' => SubCategorie::class,
            'choice_label' => 'name',
            'placeholder' => 'Sélectionnez Sous Catégorie',
        ])
        ->add('immobilierCategorie', EntityType::class, [
            'class' => ImmobilierCategorie::class,
            'choice_label' => 'name',
            'required' => false,
            'placeholder' => 'Sélectionnez Sous Catégorie',
        ])
        //Vehicule start
        ->add('voitures', VoituresType::class, [
            'required' => false,
            'label' => ' ',
        ])   
        ->add('motos', MotosType::class,[
            'required' => false,
            'label' => ' ',
        ])
        ->add('caravanning', CaravanningType::class,[
            'required' => false,
            'label' => ' ',
        ])
        ->add('camions', CamionsType::class,[
            'required' => false,
            'label' => ' ',
        ])

        //Véhicule end

        //Immobilier start

        ->add('apartmentForSale', ApartementForSaleType::class,[
            'required'=>false,
            'label'=>' ',
        ])

        ->add('apartementRental', ApartementRentalType::class,[
            'required'=>false,
            'label'=>' ',
        ])

        ->add('houseForSale', HouseForSaleType::class,[
            'required'=>false,
            'label'=>' ',
        ])

        ->add('houseRental', HouseRentalType::class,[
            'required'=>false,
            'label'=>' ',
        ])

        ->add('landForSale', LandForSaleType::class,[
            'required'=>false,
            'label'=>' ',
        ])

        ->add('submit', SubmitType::class, [
            'attr' => ['class' => 'btn btn-primary mt-4'],
            'label' => 'Publier votre annonce',
        ]);
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}