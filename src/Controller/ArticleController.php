<?php

namespace App\Controller;

use App\Entity\Annonce\Article;
use App\Entity\Annonce\Immobilier\ApartementForSale;
use App\Entity\ArticleImage;
use App\Form\Annonce\ArticleType;
use App\Repository\Annonce\ArticleRepository;
use App\Service\PictureService;
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

    #[Route('/upload-images', name: 'image_upload', methods: ['POST'])]
    public function uploadImages(Request $request, PictureService $pictureService): JsonResponse
    {
        $uploadedFiles = $request->files->all();
        $imageReferences = $request->getSession()->get('image_references', []);
    
        foreach ($uploadedFiles as $file) {
            if (!($file instanceof UploadedFile)) {
                continue;
            }
            $resizedImageName = $pictureService->add($file, '', 300, 300);
            $imageReferences[] = $resizedImageName;
        }
        
        // Stockez les références d'image dans la session ou renvoyez-les directement
        // Par exemple, en utilisant la session :
        $request->getSession()->set('image_references', $imageReferences);
    
        return new JsonResponse([
            'message' => 'Images uploaded successfully',
            'fileName' => $resizedImageName, // Renvoyez le nom de fichier modifié
            'references' => $imageReferences
        ], 200);
        
    }


    #[Route('/delete-image', name: 'delete_image', methods: ['POST'])]
    public function deleteImage(Request $request, PictureService $pictureService): JsonResponse {
        $imageName = $request->request->get('name');
        
        if ($pictureService->delete($imageName)) {
            // Supprimer la référence de l'image de la session
            $imageReferences = $request->getSession()->get('image_references', []);
            if(($key = array_search($imageName, $imageReferences)) !== false) {
                unset($imageReferences[$key]);
                $request->getSession()->set('image_references', $imageReferences);
            }
    
            return new JsonResponse(['status' => 'success', 'message' => 'Image deleted successfully']);
        }
    
        return new JsonResponse(['status' => 'error', 'message' => 'Image not found']);
    }
    
    #[Route('/clear-temp-images', name: 'clear_temp_images', methods: ['POST'])]
    public function clearTempImages(Request $request, PictureService $pictureService): JsonResponse {
        // Supprimer les images physiques
        $pictureService->clearTempImages();
    
        // Nettoyer également les références d'images dans la session
        $request->getSession()->remove('image_references');
    
        return new JsonResponse(['status' => 'success', 'message' => 'Temporary images and references cleared']);
    }
    
    

    #[Route('/ajouter-une-nouvelle-annonce', name: 'app_new.ad', methods: ['GET', 'POST'])]
    public function new_add(Request $request, EntityManagerInterface $manager, PictureService $pictureService): Response 
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setUser($this->getUser()); // Assurez-vous que getUser renvoie l'utilisateur correct
            $manager->persist($article);
            $manager->flush(); // Flush ici pour que l'article obtienne un ID
            
            $imageReferences = $request->getSession()->get('image_references', []);

            foreach ($imageReferences as $imageName) {
                $img = new ArticleImage();
                $img->setName($imageName);
                $img->setArticle($article); // Associez l'image à l'article
                $manager->persist($img);    // Persistez chaque image
            }
            $manager->flush(); // Flush après la boucle pour enregistrer toutes les images
        
            // Effacer les références d'image de la session
            $request->getSession()->remove('image_references');
            $this->addFlash('success', 'Votre annonce a été créée avec succès!');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('pages/article/new.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/annonce/{id}', name:"app_ad.show")]
    public function show(Article $article): Response
    {
        return $this->render('pages/article/show.html.twig',[
            'article'=>$article,
        ]);

    }

    #[Route('/annonce/modifier-mon-annonce/{id}', name:'app_ad.edit', methods: ['GET','POST'])]
    public function ad_edit(Article $article,
    Request $request,
    EntityManagerInterface $manager,
    PictureService $pictureService): Response
    {
        // $form = $this->createForm(ArticleType::class, $article);
    $sousCategorie = $article->getSubCategorie() ? $article->getSubCategorie()->getName() : null;

    if (!$sousCategorie) {
        throw new \Exception("Sous-catégorie non trouvée pour l'article");
    }

    $form = $this->createForm(ArticleType::class, $article, [
        'validation_groups' => [$sousCategorie], // Utilisez la variable ici
    ]);

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
