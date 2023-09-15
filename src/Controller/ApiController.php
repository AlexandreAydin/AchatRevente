<?php

namespace App\Controller;

use App\Entity\Annonce\Categorie;
use App\Entity\MakeCar;
use App\Entity\ModelCar;
use App\Entity\Annonce\SubCategorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route("/get-subCategories/{id}", name:"get_subCategories")]
    public function getsubCategories(Categorie $categorie): JsonResponse
    {
        $subCategories = $this->entityManager->getRepository(SubCategorie::class)->findBy(['categorie' => $categorie]);

        $responseArray = [];
        foreach($subCategories as $subCategorie){
            $responseArray[] = [
                'id' => $subCategorie->getId(),
                'name' => $subCategorie->getName()
            ];
        }

        return new JsonResponse($responseArray);
    }

    #[Route("/get-make-cars/{id}", name:"get_make_cars")]
    public function getMakeCars(SubCategorie $subCategorie): JsonResponse
    {
       $makeCars = $this->entityManager->getRepository(MakeCar::class)->findBy(['subCategorie' => $subCategorie]);

        $responseArray = [];
        foreach($makeCars as $makeCar){
            $responseArray[] = [
                'id' => $makeCar->getId(),
                'name' => $makeCar->getName()
            ];
        }

        return new JsonResponse($responseArray);
    }

    #[Route("/get-model-cars/{id}", name:"get_model_cars")]
    public function getModelCars(MakeCar $makeCar): JsonResponse
    {
       $modelCars = $this->entityManager->getRepository(ModelCar::class)->findBy(['makeCar' => $makeCar]);

        $responseArray = [];
        foreach($modelCars as $modelCar){
            $responseArray[] = [
                'id' => $modelCar->getId(),
                'name' => $modelCar->getName()
            ];
        }

        return new JsonResponse($responseArray);
    }
}
