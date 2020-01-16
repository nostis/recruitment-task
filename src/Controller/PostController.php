<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    /**
     * @Route("/lista", name="post")
     */
    public function list()
    {
        $posts = $this->postRepository->findAll();

        return $this->render('post/list.html.twig', [
            'posts' => $posts,
        ]);
    }

    public function delete()
    {

    }
}
