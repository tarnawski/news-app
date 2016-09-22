<?php

namespace CoreDomainBundle\Repository\Doctrine;

use CoreDomain\AbstractPostRepository;
use Doctrine\ORM\EntityRepository;
use CoreDomainBundle\Entity\Post;

class PostRepository extends EntityRepository implements AbstractPostRepository
{
    public function allPost()
    {
        return $this->findAll();
    }

    public function onePost($uuid)
    {
        return $this->find($uuid);
    }

    public function addPost($uuid, $title, $content)
    {
        $em = $this->getEntityManager();
        $newPost = new Post();
        $newPost->setUuid($uuid);
        $newPost->setTitle($title);
        $newPost->setContent($content);

        $em->persist($newPost);
        $em->flush();
    }

    public function deletePost($uuid)
    {
        $post = $this->find($uuid);
        $em = $this->getEntityManager();
        $em->remove($post);
        $em->flush();
    }
}
