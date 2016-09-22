<?php

namespace CoreDomain\Command;

use CoreDomain\AbstractPostRepository;

class DeletePostCommandHandler
{
    /** @var AbstractPostRepository */
    private $postRepository;

    public function __construct(AbstractPostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(DeletePostCommand $deletePostCommand)
    {
        $this->postRepository->deletePost($deletePostCommand->getUuid());
    }
}
