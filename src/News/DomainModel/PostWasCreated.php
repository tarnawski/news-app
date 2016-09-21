<?php

namespace News\DomainModel;

class PostWasCreated implements AbstractEvent
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    public function serialize()
    {
        return json_encode([
            'event'         => (new \ReflectionClass($this))->getShortName(),
            'title'         => $this->title,
            'content'       => $this->content
        ], JSON_UNESCAPED_UNICODE);
    }
}