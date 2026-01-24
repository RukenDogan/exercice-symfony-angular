<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


final class ApiUserController extends AbstractController
{
    #[Route('/api/users', name: 'api_users_list', methods: ['GET'])]
    public function list(UserRepository $userRepository): JsonResponse
    {
        return $this->json(
            $userRepository->findAll(),
            context: ['groups' => ['user:read']]
        );
    }

    #[Route('/api/users/{id}', name: 'api_user_show', methods: ['GET'])]
    public function show(User $user): JsonResponse
    {
        return $this->json(
            $user,
            200,
            [],
            ['groups' => ['user:read']]
        );
    }

    #[Route('/api/users/{id}', name: 'api_users_delete', methods: ['DELETE'])]
    public function delete(
        User $user,
        EntityManagerInterface $em
    ): JsonResponse {
        $em->remove($user);
        $em->flush();

        return $this->json(null, 204);
    }


    #[Route('/api/users', name: 'api_users_create', methods: ['POST'])]
    public function create(
        Request $request,
        EntityManagerInterface $em
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        $user = new User();
        $user->setNom($data['nom'] ?? '');
        $user->setPrenom($data['prenom'] ?? '');
        $user->setEmail($data['email'] ?? '');
        $user->setAdresse($data['adresse'] ?? '');
        $user->setTel($data['tel'] ?? '');
        if (!empty($data['birthDate'])) {
            $user->setBirthDate(new \DateTime($data['birthDate']));
        }


        $em->persist($user);
        $em->flush();

        return $this->json(
            $user,
            Response::HTTP_CREATED,
            [],
            ['groups' => ['user:read']]
        );
    }

}
