<?php

namespace App\Controller;


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
        $articles = $paginator->paginate(
            $repository ->paginationQuery(),
                $request->query->getInt('page', 1),
                30
            );

        return $this->render('pages/home/index.html.twig', [
            'controller_name' => 'HomeController',
            'articles' => $articles
        ]);
    }
}
    