<?php

namespace Common;

class PostWasCreated implements AbstractEvent
{
    private $uuid;
    private $title;
    private $content;

    public function __construct($uuid, $title, $content)
    {
        $this->uuid = $uuid;
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
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
            'uuid'          => $this->uuid,
            'title'         => $this->title,
            'content'       => $this->content
        ], JSON_UNESCAPED_UNICODE);
    }
}
