<?php

namespace NewsBundle\Service;

use News\DomainModel\PostWasCreated;
use Doctrine\ORM\EntityManager;
use News\AbstractEventProjector;
use NewsBundle\Entity\Post;

class EventProjectorService implements AbstractEventProjector
{
    /** @var EntityManager */
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function project($event)
    {
        $projectMethod = 'project' . (new \ReflectionClass($event))->getShortName();
        $this->$projectMethod($event);
    }

    public function projectPostWasCreated(PostWasCreated $event)
    {
        $post = new Post();
        $post->setTitle($event->getTitle());
        $post->setContent($event->getContent());

        $this->em->persist($post);
        $this->em->flush();
    }
}