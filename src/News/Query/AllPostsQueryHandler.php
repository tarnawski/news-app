<?php

namespace News\Query;

class AllPostsQueryHandler
{
    private $postRepository;

    public function __construct($postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(AllPostsQuery $allPostsQuery)
    {
        return $this->postRepository->all();
    }
}