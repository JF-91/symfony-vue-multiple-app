<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register', methods: ['GET'])]
    public function register(): Response
    {
        return $this->render('registration/register.html.twig');
    }

    #[Route('/app', name: 'app_app')]
    public function app(): Response
    {
        return $this->render('app/index.html.twig');
    }


    #[Route('/register', name: 'app_register_post', methods: ['POST'])]
    public function registerPost(
        Request $request, 
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager): RedirectResponse|JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        
        $user = new User();

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->submit($data);

      
        unset($data['_token']);

    
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )   
            );

            $user->setRoles(['ROLE_USER']);

            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->json(['message' => 'User created'], Response::HTTP_CREATED);
            // return $this->redirectToRoute('app_app');
        }
        else {
            $errors = [];
            foreach ($form->getErrors(true) as $error) {
                $errors[$error->getOrigin()->getName()] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }
    }
}
