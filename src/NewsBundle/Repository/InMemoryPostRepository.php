<?php

namespace NewsBundle\Repository;

use News\Model\Post;
use News\Model\PostId;

class InMemoryPostRepository
{
    private $posts;

    public function __construct()
    {
        $this->posts[] = new Post(new PostId(1), 'New app', 'New app in google store');
        $this->posts[] = new Post(new PostId(2), 'Very important', 'It is very important message');
    }

    public function all()
    {
        return $this->posts;
    }

    public function find($id)
    {
        /** @var Post $post */
        foreach ($this->posts as $post) {
            if ($post->getId() == $id) {
                return $post;
            }
        }

        return [];
    }

    public function add(Post $post)
    {
        $this->posts[] = $post;
    }
}