<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

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
}
