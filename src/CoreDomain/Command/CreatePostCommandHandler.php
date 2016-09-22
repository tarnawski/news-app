<?php

namespace CoreDomain\Command;

use CoreDomain\AbstractPostRepository;
use CoreDomain\Model\Post;
use CoreDomain\Model\PostId;

class CreatePostCommandHandler
{
    /** @var AbstractPostRepository */
    private $postRepository;

    public function __construct(AbstractPostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(CreatePostCommand $createPostCommand)
    {
        $post = new Post(
            PostId::generate(),
            $createPostCommand->getTitle(),
            $createPostCommand->getContent()
        );

        $this->postRepository->addPost($post);
    }
}
