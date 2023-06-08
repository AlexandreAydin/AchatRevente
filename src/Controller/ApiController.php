<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\MakeCar;
use App\Entity\ModelCar;
use App\Entity\Vehicle;
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


    #[Route("/get-vehicles/{id}", name:"get_vehicles")]
    public function getVehicles(Categorie $categorie): JsonResponse
    {
        $vehicles = $this->entityManager->getRepository(Vehicle::class)->findBy(['categorie' => $categorie]);

        $responseArray = [];
        foreach($vehicles as $vehicle){
            $responseArray[] = [
                'id' => $vehicle->getId(),
                'name' => $vehicle->getName()
            ];
        }

        return new JsonResponse($responseArray);
    }

    #[Route("/get-make-cars/{id}", name:"get_make_cars")]
    public function getMakeCars(Vehicle $vehicle): JsonResponse
    {
       $makeCars = $this->entityManager->getRepository(MakeCar::class)->findBy(['vehicle' => $vehicle]);

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
