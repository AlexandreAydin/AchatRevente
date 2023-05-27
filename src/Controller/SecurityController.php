<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/connexion', name: 'app_security.login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('pages/security/login.html.twig', [
          'last_username' => $authenticationUtils->getLastUsername(),
          'error'=>$authenticationUtils->getLastAuthenticationError()
        ]);
    }

    #[Route('/deconnexion', name:'app_security.logout')]
    public function logout()
    {
        
    }

    #[Route('/inscription',name:'app_security.registration',methods:['GET','POST'])]
    public function registration(HttpFoundationRequest $request, EntityManagerInterface $manager)
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user=$form->getData();
            $this->addFlash(
                'succes',
                'Votre compte a été créé avec succès'
            );
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('app_security.login');
        }

        return $this->render('pages/security/registration.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}
