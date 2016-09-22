<?php

namespace Common;

class PostWasRemoved implements AbstractEvent
{
    private $uuid;

    public function __construct($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    public function serialize()
    {
        return json_encode([
            'event'         => (new \ReflectionClass($this))->getShortName(),
            'uuid'          => $this->uuid
        ], JSON_UNESCAPED_UNICODE);
    }
}
