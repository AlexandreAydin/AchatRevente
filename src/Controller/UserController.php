<?php

namespace App\Controller;

use App\Entity\User;
use app\Form\UserPasswordType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/utilisateur/edition/{id}', name: 'app_user.edit', methods:['GET', 'POST'])]
    public function index(
        User $choosenUser,
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordHasherInterface $hasher,
    ): Response
    {
        $form = $this->createForm(UserType::class, $choosenUser);

        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
             // si le mot de passe est correcte alors on autorise la modification
            if($hasher->isPasswordValid($choosenUser,$form->getData()->getPlainPassword())){
                $user=$form->getData();
                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'succes',
                    'Les information de votre compte a bien été modifier.'
                );
                return $this->redirectToRoute('app_annonce');
            }else{
                $this->addFlash(
                    'warning',
                    'Le mot de passe renseigné est incorrect.'
                );
            }
        }
   
        return $this->render('pages/user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    #[Route('utilisateur/edition-mot-de-passe/{id}', name:'app_user.edit.password', methods:['GET', 'POST'])]
    public function editPassword(
        User $choosenUser,
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordHasherInterface $hasher
    ):Response
    {
        $form = $this->createForm(UserPasswordType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            if ($hasher->IsPasswordValid($choosenUser,$form->getdata()['plainPassword'])){
                $choosenUser->setUpdatedAt(new \DateTimeImmutable());
                $choosenUser->setPlainPassword(
                    $form->getData()['newPassword']
                );                      
                $manager->persist($choosenUser);
                $manager->flush();

                $this->addflash(
                    'succes',
                    'Votre mot de passe a bien été modifier.'
                );
                return $this->redirectToRoute('app_annonce');
            }else{
                $this->addflash(
                    'warning',
                    'Le mot de passe renseigné est incorrect.'
                );
            }
        }
            return $this->render('pages/user/edit_password.html.twig', [
                'form' => $form->createView()
            ]);
    }
}
