<?php

namespace CoreDomain\Query;

use CoreDomain\AbstractPostRepository;

class AllPostsQueryHandler
{
    /** @var AbstractPostRepository */
    private $postRepository;

    public function __construct(AbstractPostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(AllPostsQuery $allPostsQuery)
    {
        return $this->postRepository->allPost();
    }
}
