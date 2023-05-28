<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/mes-annonces-postees', name: 'app_annonce')]
    public function index(ArticleRepository $repository,
    Request $request): Response
    {
        $articles=$repository->findBy(['user'=>$this->getUser()]);

        return $this->render('pages/article/index.html.twig', [
            'articles'=> $articles
        ]);
    }

    #[Route('/ajouter-une-nouvelle-annonce',name:'app_new.annonce')]
    public function new_annonce(ArticleRepository $articles,
    Request $request,
    EntityManagerInterface $manager): Response
    {
        
    }
}
