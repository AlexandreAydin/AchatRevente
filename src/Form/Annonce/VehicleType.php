<?php

namespace App\Form\Annonce;

use App\Entity\Annonce\Article;
use App\Entity\MakeCar;
use App\Entity\ModelCar;
use App\Repository\MakeCarRepository;
use App\Repository\ModelCarRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class VehicleType extends AbstractType
{
    private $makeCarRepository;
    private  $modelCarRepository;

    public function __construct(
    MakeCarRepository $makeCarRepository,
    ModelCarRepository $modelCarRepository,)
    {
        $this->makeCarRepository = $makeCarRepository;
        $this->modelCarRepository = $modelCarRepository;

    }



    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
      
        $makeCars = $this->makeCarRepository->findAll();
        $modelCars = $this->modelCarRepository->findAll();
    
    
        $makeCarChoices = [];
        $modelCarChoices = [];
    
     
        foreach ($makeCars as $makeCar) {
            $makeCarChoices[$makeCar->getId()] = $makeCar;
        }
        foreach ($modelCars as $modelCar) {
            $modelCarChoices[$modelCar->getId()] = $modelCar;
        }
    
        $builder
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
            ]);
        
        }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
