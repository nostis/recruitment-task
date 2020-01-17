<?php

namespace App\Tests\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testWhenGetPostsThenOk()
    {
        $client = static::createClient();

        $client->request('GET', '/api/posts');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testWhenGetListAsNotLoggedInThenRedirectToLogin()
    {
        $client = static::createClient();

        $client->request('GET', '/lista');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    } 

    public function testWhenLogInAndGetListThenOk()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'user',
            'PHP_AUTH_PW' => 'password'
        ]);

        $client->request('GET', '/lista');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testWhenNotLoggedInAndDeletePostThenRedirectToLogin()
    {
        $client = static::createClient();

        $client->request('DELETE', '/lista/5');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    /*public function testWhenLoggedInAndDeletePostThenOk()
    {
        $post = new Post();
        $post->setTitle('title');
        $post->setBody('body');
        $post->setName('name');

        $postRepository = $this->createMock(PostRepository::class);

        $postRepository->expects($this->once())
            ->method('find')
            ->willReturn($post);

            
        $postRepository->expects($this->any())
            ->method('delete')
            ->willReturn('');

        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'user',
            'PHP_AUTH_PW' => 'password'
        ]);

        $client->request('DELETE', '/lista/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }*/
}