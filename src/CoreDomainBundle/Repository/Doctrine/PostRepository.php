<?php

namespace CoreDomainBundle\Repository\Doctrine;

use Doctrine\ORM\EntityRepository;
use CoreDomain\AbstractPostRepository;
use CoreDomain\Model\Post;
use CoreDomainBundle\Entity\Post as PostImpl;

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

    public function addPost(Post $post)
    {
        $em = $this->getEntityManager();
        $newPost = new PostImpl();
        $newPost->setUuid($post->getId()->getValue());
        $newPost->setTitle($post->getTitle());
        $newPost->setContent($post->getContent());

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
