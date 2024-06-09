<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;


#[Route('/api')]
class UserController extends AbstractController
{


    private $entityManager;
    private $serializer;
    private $hashUserPassword;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $hashUserPassword,
        SerializerInterface $serializer) {
            $this->entityManager = $entityManager;
            $this->serializer = $serializer;
            $this->hashUserPassword = $hashUserPassword;
            
    }


    #[Route('/user', name: 'api_user', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $data = $this->entityManager->getRepository(User::class)->findAll();
        $users = $this->serializer->serialize($data, 'json');

        return new JsonResponse($users, 200, [], true);
    }

    #[Route('/user/{id}', name: 'api_user_show', methods: ['GET'])]
    public function show($id): JsonResponse
    {
        $data = $this->entityManager->getRepository(User::class)->find($id);
        $user = $this->serializer->serialize($data, 'json');

        return new JsonResponse($user, 200, [], true);
    }

    #[Route('/user/{email}', name: 'api_user_show_by_email', methods: ['GET'])]
    public function showByEmail($email): JsonResponse
    {
        $data = $this->entityManager->getRepository(User::class)->findByEmail($email);
        $user = $this->serializer->serialize($data, 'json');

        return new JsonResponse($user, 200, [], true);
    }

    #[Route('/user', name: 'api_user_create', methods: ['POST'])]
    public function create(Request $request, UserPasswordHasherInterface $userPasswordHasher): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = new User();
        $form = $this->createForm(UserFormType::class, $user);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $user->setRoles(['ROLE_USER']);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return new JsonResponse(['message' => 'User created'], Response::HTTP_CREATED);
        }
        else {
            return new JsonResponse(['message' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/user/{id}', name: 'api_user_update', methods: ['PUT'])]
    public function update($id, Request $request): JsonResponse
    {
        try {
            $user = $this->entityManager->getRepository(User::class)->find($id);
                
            if(!$user) {
                return new JsonResponse(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
            }

            $data = json_decode($request->getContent(), true);


            if($data['firstName']) {
                $user->setFirstName($data['firstName']);
            }

            if($data['lastName']) {
                $user->setLastName($data['lastName']);
            }

            if($data['email']) {
                $user->setEmail($data['email']);
            }

            if($data['password']) {
                $user->setPassword(
                    $this->hashUserPassword->hashPassword(
                        $user,
                        $data['password']
                    )
                );
            }


            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return new JsonResponse(['message' => 'User updated'], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return new JsonResponse(['error'=> $th->getMessage() ,'message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }
  
    }

    #[Route('/user/{id}', name: 'api_user_delete', methods: ['DELETE'])]
    public function delete($id): JsonResponse
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);

        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'User deleted'], Response::HTTP_OK);
    }


}
