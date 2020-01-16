<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    private $managerRegistry;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);

        $this->managerRegistry = $registry;
    }

    public function save(Post $post)
    {
        $entityManager = $this->managerRegistry->getManagerForClass(Post::class);

        $entityManager->persist($post);
        $entityManager->flush();
    }
}
