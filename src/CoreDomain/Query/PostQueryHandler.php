<?php

namespace CoreDomain\Query;

use CoreDomain\AbstractPostRepository;

class PostQueryHandler
{
    /** @var AbstractPostRepository */
    private $postRepository;

    public function __construct(AbstractPostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(PostQuery $postsQuery)
    {
        return $this->postRepository->onePost($postsQuery->getId());
    }
}
