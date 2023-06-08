<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\ArticleImage;
use App\Entity\Images;
use App\Form\ArticleType;
use App\Service\PictureService;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;



class ArticleController extends AbstractController
{
    #[Route('/mes-annonces-postees', name: 'app_ad')]
    public function index(ArticleRepository $repository,
    ): Response
    {
        $articles=$repository->findBy(['user'=>$this->getUser()]);

        return $this->render('pages/article/index.html.twig', [
            'articles'=> $articles
        ]);
    }

    #[Route('/ajouter-une-nouvelle-annonce', name: 'app_new.ad')]
public function new_add(
    Request $request,
    EntityManagerInterface $manager,
    PictureService $pictureService
): Response {
    $article = new Article();
    $form = $this->createForm(ArticleType::class, $article);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $images = $form->get('images')->getData();
        foreach ($images as $image) {
            if (!($image instanceof UploadedFile)) {
                continue;
            }

            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Add a check here to make sure $imageName is not an empty string
            if (!$imageName || trim($imageName) == '') {
                throw new \Exception('Image name not generated or empty');
            }

            $img = new ArticleImage();
            $img->setName($imageName);

            // Redimensionner l'image à 300x300 pixels
            $resizedImageName = $pictureService->add($image, 300, 300);
            $img->setName($resizedImageName);

            $article->addImage($img);
        }

        $article->setUser($this->getUser());

        $manager->persist($article);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre annonce a été créée avec succès!'
        );
        return $this->redirectToRoute('app_ad');
    }

    return $this->render('pages/article/new.html.twig', [
        'form' => $form->createView()
    ]);
}

    

    #[Route('/annonce/{id}', name:"app_ad.show")]
    public function show(Article $article): Response
    {
        return $this->render('pages/article/show.html.twig',[
            'article'=>$article
        ]);

    }

    #[Route('/annonce/modifier-mon-annonce/{id}', name:'app_ad.edit', methods: ['GET','POST'])]
    public function ad_edit(Article $article,
    Request $request,
    EntityManagerInterface $manager,
    PictureService $pictureService): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $images = $form->get('images')->getData();
            foreach($images as $image){
                
            
                // On appelle le service d'ajout
                $fichier = $pictureService->add($image, 300, 300);
            
                $img = new ArticleImage();
                $img->setName($fichier);
                $article->addImage($img);
            
                // Persist the new Images instance
                $manager->persist($img);
            }
            $article = $form->getData();
            $manager->persist($article);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre annonce a été modifier avec succès!'
            );

            return $this->redirectToRoute('app_ad');
        }

        return $this->render('pages/article/edit.html.twig',[
            'form'=>$form->createView(),
            'article'=>$article
        ]);
    }

    #[Route('/annonce/suppression/{id}' , name:'app_ad.delete', methods:['GET'])]
    public function delete(EntityManagerInterface $manager,
    Article $article): Response
    {
        $manager->remove($article);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre annonce a été supprimer avec succès!'
        );

        return $this->redirectToRoute('app_ad');
    } 



    
    #[Route('/annonce/suppression/image/{id}', name: 'app_ad.delete_image', methods: ['GET'])]
    public function delete_image(EntityManagerInterface $manager, int $id, UrlGeneratorInterface $urlGenerator): RedirectResponse
    {
        $image = $manager->getRepository(ArticleImage::class)->find($id);
    
        if (!$image) {
            throw $this->createNotFoundException('Image not found');
        }
    
        $article = $image->getArticle(); // Récupérer l'article associé à l'image
    
        $manager->remove($image);
        $manager->flush();
    
        $editUrl = $urlGenerator->generate('app_ad.edit', ['id' => $article->getId()]);
    
        return new RedirectResponse($editUrl);
    }
    
}
