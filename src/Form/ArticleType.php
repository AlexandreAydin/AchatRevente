<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Vehicle;
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
    private $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository,)
    {
        $this->vehicleRepository = $vehicleRepository;

    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
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
            ->add('categorie', EntityType::class, [
                'mapped' => false,
                'class' => Categorie::class,
                'choice_label' => 'name',
                'placeholder' => 'Catégorie',
                'label' => 'Catégorie',
                'required' => false,
                // 'query_builder' => fn (CategorieRepository $categorieRepository)
                //  => $categorieRepository->createQueryBuilder('c')->orderBy('c.name', 'ASC')           
            ])
            ->add('vehicle', ChoiceType::class, [
                'choices' => $this->vehicleRepository->findAll(),
                'choice_label' => 'name',
                'placeholder' => 'Sélectionnez type de votre véhicule',
                'required' => false,
                'label' => 'Véhicule'
            ])
          
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ],
                'label' => 'Publier votre annonce',
            ]);         


            $formModifier = function (FormInterface $form, Categorie $categorie = null) {
                $vehicle = null === $categorie ? [] : $categorie->getVehicles();
    
                $form->add('vehicle', EntityType::class, [
                    'class' => Vehicle::class,
                    'choices' => $vehicle,
                    'required' => false,
                    'choice_label' => 'name',
                    'placeholder' => 'Choisir le véhicule',
                    'attr' => ['class' => 'custom-select'],
                    'label' => 'Véhicule'
                ]);
            };
    
            $builder->get('categorie')->addEventListener(
                FormEvents::POST_SUBMIT,
                function (FormEvent $event) use ($formModifier) {
                    $categorie = $event->getForm()->getData();
                    $formModifier($event->getForm()->getParent(), $categorie);
                }
            );        
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
