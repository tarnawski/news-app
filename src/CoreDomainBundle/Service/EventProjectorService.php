<?php

namespace CoreDomainBundle\Service;

use Common\PostWasCreated;
use Common\PostWasRemoved;
use CoreDomainBundle\Repository\Doctrine\PostRepository;
use CoreDomain\AbstractEventProjector;

class EventProjectorService implements AbstractEventProjector
{
    /** @var PostRepository  */
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function project($event)
    {
        $projectMethod = 'project' . (new \ReflectionClass($event))->getShortName();
        $this->$projectMethod($event);
    }

    public function projectPostWasCreated(PostWasCreated $event)
    {
        $this->postRepository->addPost(
            $event->getUuid(),
            $event->getTitle(),
            $event->getContent()
        );
    }

    public function projectPostWasRemoved(PostWasRemoved $event)
    {
        $this->postRepository->deletePost(
            $event->getUuid()
        );
    }
}
