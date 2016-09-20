<?php

namespace News\Command;

class CreatePostCommand
{
    private $title;

    private $content;

    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }
}