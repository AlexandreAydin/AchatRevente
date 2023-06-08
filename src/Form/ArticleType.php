<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\MakeCar;
use App\Entity\ModelCar;
use App\Entity\Vehicle;
use App\Repository\CategorieRepository;
use App\Repository\MakeCarRepository;
use App\Repository\ModelCarRepository;
use App\Repository\VehicleRepository;
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
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;


class ArticleType extends AbstractType
{
    private $categorieRepository;
    private $vehicleRepository;
    private $makeCarRepository;
    private  $modelCarRepository;

    public function __construct(CategorieRepository $categorieRepository,
    VehicleRepository $vehicleRepository,
    MakeCarRepository $makeCarRepository,
    ModelCarRepository $modelCarRepository,)
    {
        $this->categorieRepository = $categorieRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->makeCarRepository = $makeCarRepository;
        $this->modelCarRepository = $modelCarRepository;

    }



    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $categories = $this->categorieRepository->findAll();
        $vehicles = $this->vehicleRepository->findAll();
        $makeCars = $this->makeCarRepository->findAll();
        $modelCars = $this->modelCarRepository->findAll();
    
        $categorieChoices = [];
        $vehicleChoices = [];
        $makeCarChoices = [];
        $modelCarChoices = [];
    
        foreach ($categories as $categorie) {
            $categorieChoices[$categorie->getId()] = $categorie;
        }
        foreach ($vehicles as $vehicle) {
            $vehicleChoices[$vehicle->getId()] = $vehicle;
        }
        foreach ($makeCars as $makeCar) {
            $makeCarChoices[$makeCar->getId()] = $makeCar;
        }
        foreach ($modelCars as $modelCar) {
            $modelCarChoices[$modelCar->getId()] = $modelCar;
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
            ->add('categorie', ChoiceType::class, [
                'choices' => $categorieChoices,
                'choice_value' => function (?Categorie $entity) {
                    return $entity ? $entity->getId() : '';
                },
                'choice_label' => 'name',
                'placeholder' => 'Sélectionnez type de votre véhicule',
                'required' => false,
                'label' => 'Véhicule'
            ])
            ->add('vehicle', ChoiceType::class, [
                'choices' => $vehicleChoices,
                'choice_value' => function (?Vehicle $entity) {
                    return $entity ? $entity->getId() : '';
                },
                'choice_label' => 'name',
                'placeholder' => 'Sélectionnez type de votre véhicule',
                'required' => false,
                'label' => 'Véhicule'
            ])
            ->add('makeCar', ChoiceType::class, [
                'choices' => $makeCarChoices,
                'choice_value' => function (?MakeCar $entity) {
                    return $entity ? $entity->getId() : '';
                },
                'choice_label' => 'name',
                'placeholder' => 'Sélectionnez la marque de votre véhicule',
                'required' => false,
                'label' => 'Marque'
            ])
            ->add('modelCar', ChoiceType::class, [
                'choices' => $modelCarChoices,
                'choice_value' => function (?ModelCar $entity) {
                    return $entity ? $entity->getId() : '';
                },
                'choice_label' => 'name',
                'placeholder' => 'Sélectionnez la marque de votre véhicule',
                'required' => false,
                'label' => 'Marque'
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
