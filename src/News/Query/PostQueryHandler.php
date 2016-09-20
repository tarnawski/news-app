<?php

namespace News\Query;

class PostQueryHandler
{
    private $postRepository;

    public function __construct($postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(PostQuery $postsQuery)
    {
        return $this->postRepository->find($postsQuery->getId());
    }
}