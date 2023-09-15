<?php

namespace App\Form\Annonce;

use App\Entity\Annonce\Article;
use App\Entity\Annonce\Categorie;
use App\Entity\Annonce\SubCategorie;
use App\Form\Annonce\MultiMedia\ConsoleAndGamesType;
use App\Form\Annonce\Vehicule\VoituresType;
use App\Repository\Annonce\CategorieRepository;
use App\Repository\Annonce\SubCategorieRepository;
use App\Repository\Annonce\Vehicule\VoituresRepository;
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

    private $categorieRepository;
    private $subCategorieRepository;
    private $voituresRepository;


    public function __construct(
    CategorieRepository $categorieRepository,
    SubCategorieRepository $subCategorieRepository,
    VoituresRepository $voituresRepository)
    {
        $this->categorieRepository = $categorieRepository;
        $this->subCategorieRepository = $subCategorieRepository;
        $this->voituresRepository = $voituresRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $categories = $this->categorieRepository->findAll();
        $subCategories = $this->subCategorieRepository->findAll();
        $voitures =  $this->voituresRepository->findAll();


        $categorieChoices = [];
        $subCategorieChoices = [];
        $voituresChoices = [];


        foreach ($categories as $categorie) {
            $categorieChoices[$categorie->getId()] = $categorie;
        }
        foreach ($subCategories as $subCategorie) {
            $subCategorieChoices[$subCategorie->getId()] = $subCategorie;
        }

        foreach ($voitures as $voiture) {
            $voituresChoices[$voiture->getId()] = $voiture;
        }
      
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
            // ->add('categorie', ChoiceType::class, [
            //     'choices' => $categorieChoices,
            //     'choice_value' => function (?Categorie $entity) {
            //         return $entity ? $entity->getId() : '';
            //     },
            //     'choice_label' => 'name',
            //     'placeholder' => 'Sélectionnez votre Catégorie',
            //     'required' => false,
            //     'label' => 'Véhicule'
            // ])
            // ->add('subCategorie', ChoiceType::class, [
            //     'choices' => $subCategorieChoices,
            //     'choice_value' => function (?SubCategorie $entity) {
            //         return $entity ? $entity->getId() : '';
            //     },
            //     'choice_label' => 'name',
            //     'placeholder' => 'Sélectionnez Sous Catégorie',
            //     'required' => false,
            //     'label' => 'Véhicule'
            // ])

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
            ->add('voitures', VoituresType::class, [
                'label' => 'Voiture',
                'required' => false,
                'attr' => [
                    'style' => 'display:none;'
                ],
            ])
            ->add('consoleAndGames', ConsoleAndGamesType::class, [
                'label' => 'consoleAndGames',
                'required' => false,
                'attr' => [
                    'style' => 'display:none;'
                ],
            ])
            
            ->add('voitures', VoituresType::class, [
                'label' => 'Voiture',
                'required' => false,
            ])
            ->add('consoleAndGames', ConsoleAndGamesType::class, [
                'label' => 'consoleAndGames',
                'required' => false,
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