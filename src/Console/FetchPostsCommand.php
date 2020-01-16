<?php 

namespace App\Command;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;

class FetchPostsCommand extends Command
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;

        parent::__construct();
    }

    protected function configure()
    {
        //parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = HttpClient::create();

        $response = $client->request('GET', 'https://jsonplaceholder.typicode.com/posts');
        $posts = json_decode($response->getContent());

        foreach($posts as $post)
        {
            $response = $client->request('GET', 'https://jsonplaceholder.typicode.com/users/' . $post->userId);
            $user = json_decode($response->getContent());

            $postToSave = new Post();
            
            $postToSave->setTitle($post->title);
            $postToSave->setBody($post->body);
            $postToSave->setName($user->name);

            $this->postRepository->save($postToSave);
        }

        return 0;
    }
}