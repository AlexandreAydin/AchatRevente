<?php

namespace App\Controller;

use App\Entity\Annonce\Categorie;
use App\Entity\Annonce\SubCategorie;
use App\Entity\Annonce\Vehicule\Motos\MakeOfMoto;
use App\Entity\Annonce\Vehicule\Motos\MotoModel;
use App\Entity\Annonce\Vehicule\Voitures\CarModel;
use App\Entity\Annonce\Vehicule\Voitures\MakeOfCar;
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

    // Vehicule start 
    // voitures 
    #[Route("/get-carModels/{id}", name:"get_carModels")]
    public function getCarModels(MakeOfCar $makeOfCar): JsonResponse
    {
        $carModels = $this->entityManager->getRepository(CarModel::class)->findBy(['makeOfCar' => $makeOfCar]);

        $responseArray = [];
        foreach($carModels as $carModel){
            $responseArray[] = [
                'id' => $carModel->getId(),
                'name' => $carModel->getName()
            ];
        }
        return new JsonResponse($responseArray);
    }

    // Motos
    #[Route("/get-motoModels/{id}", name:"get_motoModels")]
    public function getMotoModels(MakeOfMoto $makeOfMoto): JsonResponse
    {
        $motoModels = $this->entityManager->getRepository(MotoModel::class)->findBy(['makeOfMoto' => $makeOfMoto]);

        $responseArray = [];
        foreach($motoModels as $motoModel){
            $responseArray[] = [
                'id' => $motoModel->getId(),
                'name' => $motoModel->getName()
            ];
        }
        return new JsonResponse($responseArray);
    }
}
