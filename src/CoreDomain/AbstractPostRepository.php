<?php

namespace CoreDomain;

use CoreDomain\Model\Post;

interface AbstractPostRepository
{
    public function allPost();

    public function onePost($uuid);

    public function addPost(Post $post);

    public function deletePost($uuid);
}
