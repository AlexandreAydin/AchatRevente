<?php

namespace App\Controller;

use App\Entity\SearchArticle;
use App\Form\SearchArticleType;
use App\Repository\Annonce\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ArticleRepository $repository,PaginatorInterface $paginator, Request $request): Response
    {

        $articles = $repository->findAll();

        $search = new SearchArticle();
        $form = $this->createForm(SearchArticleType::class, $search);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $filteredArticles = $repository->findWithSearch($search); // Stocker les résultats filtrés dans une nouvelle variable
            // dd($filteredArticles);
        } else {
            $filteredArticles = $articles; // Utiliser tous les articles par défaut
        }

        // $articles = $paginator->paginate(
        //     $repository ->paginationQuery(),
        //         $request->query->getInt('page', 1),
        //         1
        // );

        $pagination = $paginator->paginate(
            $filteredArticles, // Remplacez ceci par votre liste d'articles paginés
            $request->query->getInt('page', 1), // Numéro de page par défaut
            30, // Nombre d'articles par page
            ['defaultSortFieldName' => 'id', 'defaultSortDirection' => 'desc'] // Spécifiez l'ordre de tri par défaut
        );

        return $this->render('pages/home/index.html.twig', [
            'controller_name' => 'HomeController',
            'articles' => $filteredArticles,
            'pagination' =>  $pagination,
            'search' => $form->createView(),
        ]);
    }
}
    