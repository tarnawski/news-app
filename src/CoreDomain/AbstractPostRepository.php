<?php

namespace CoreDomain;

use CoreDomain\Model\Post;

interface AbstractPostRepository
{
    public function allPost();

    public function onePost($uuid);

    public function addPost($uuid, $title, $content);

    public function deletePost($uuid);
}
