<?php

namespace App\Form\Annonce;

use App\Entity\Annonce\Article;
use App\Entity\Annonce\MultiMedia;
use App\Entity\Annonce\Vehicle;
use App\Entity\Categorie;
use App\Entity\MakeCar;
use App\Entity\ModelCar;
use App\Entity\SubCategorie;
use App\Repository\Annonce\VehicleRepository;
use App\Repository\CategorieRepository;
use App\Repository\MakeCarRepository;
use App\Repository\ModelCarRepository;
use App\Repository\SubCategorieRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
    private $vehicleRepository;


    public function __construct(
    CategorieRepository $categorieRepository,
    SubCategorieRepository $subCategorieRepository,
    VehicleRepository $vehicleRepository,)
    {
        $this->categorieRepository = $categorieRepository;
        $this->subCategorieRepository = $subCategorieRepository;
        $this->vehicleRepository = $vehicleRepository;
    }



    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $categories = $this->categorieRepository->findAll();
        $subCategories = $this->subCategorieRepository->findAll();
        $vehicles = $this->vehicleRepository->findAll();
    
        $categorieChoices = [];
        $subCategorieChoices = [];
        $vehicleRepositoryChoices = [];
    
        foreach ($categories as $categorie) {
            $categorieChoices[$categorie->getId()] = $categorie;
        }
        foreach ($subCategories as $subCategorie) {
            $subCategorieChoices[$subCategorie->getId()] = $subCategorie;
        }
        foreach ($vehicles as $vehicle) {
            $vehicleRepositoryChoices[$vehicle->getId()] = $vehicle;
        }
    
        $builder
            ->add('title', TextType::class,[
                'attr'=>['form-control'],
            ])
            ->add('description', TextareaType::class,[
                'attr'=>['form-control'],
                'label'=>"description",
                'label_attr'=>['class','form-label mt-4']
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
            ->add('subCategorie', ChoiceType::class, [
                'choices' => $subCategorieChoices,
                'choice_value' => function (?SubCategorie $entity) {
                    return $entity ? $entity->getId() : '';
                },
                'choice_label' => 'name',
                'placeholder' => 'Sélectionnez type de votre véhicule',
                'required' => false,
                'label' => 'Véhicule'
            ])
            ->add('vehicle', EntityType::class, [
                'class' => Vehicle::class,
                'choices' => $vehicles,
                'choice_label' => 'makeCar',  // Assurez-vous que `name` est un attribut valide de Vehicle
            ])
        ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ],
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
