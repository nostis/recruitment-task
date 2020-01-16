<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    /**
     * @Route("/lista", name="post", methods={"GET"})
     */
    public function list()
    {
        $posts = $this->postRepository->findAll();

        return $this->render('post/list.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/lista/{postId}", name="delete", methods={"DELETE"})
     */
    public function delete($postId)
    {
        $post = $this->postRepository->find($postId);

        $this->postRepository->delete($post);

        return new Response('Successfully deleted post');
    }
}
