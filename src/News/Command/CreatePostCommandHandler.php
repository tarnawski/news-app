<?php

namespace News\Command;

use News\Model\Post;
use News\Model\PostId;

class CreatePostCommandHandler
{
    private $postRepository;

    public function __construct($postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(CreatePostCommand $createPostCommand)
    {
        $postId = new PostId(rand(0,100));
        $post = new Post(
            $postId,
            $createPostCommand->getTitle(),
            $createPostCommand->getContent()
        );

        $this->postRepository->add($post);
    }
}