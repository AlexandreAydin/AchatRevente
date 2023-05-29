<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/mes-annonces-postees', name: 'app_ad')]
    public function index(ArticleRepository $repository,
    Request $request): Response
    {
        $articles=$repository->findBy(['user'=>$this->getUser()]);

        return $this->render('pages/article/index.html.twig', [
            'articles'=> $articles
        ]);
    }

    #[Route('/ajouter-une-nouvelle-annonce',name:'app_new.ad')]
    public function new_add(
    Request $request,
    EntityManagerInterface $manager): Response
    {
        $article = new Article();
        $form=$this->createForm(ArticleType::class,$article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article =  $form->getData(); 

            $article->setUser($this->getUser());

            $manager->persist($article);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre recette a été créé avec succès!'
            );
            return $this->redirectToRoute('app_ad');
        }

        return $this->render('pages/article/new.html.twig',[
            'form'=>$form->createView()
        ]);    
    }
}
