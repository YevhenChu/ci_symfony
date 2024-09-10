<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\PostService;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    #[Route('/post', name: 'posts', methods: ['GET'])]
    public function publishedPosts(PostService $postService) : JsonResponse
    {
        return $this->json($postService->getPublishedPosts());
    }

    #[Route(path: 'post/{id}', name: 'post', methods: ['GET'])]
    public function postById(PostService $postService, int $id) : JsonResponse
    {
        return $this->json($postService->getPostById($id));
    }
}
