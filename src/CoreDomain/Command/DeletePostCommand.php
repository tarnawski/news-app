<?php

namespace CoreDomain\Command;

class DeletePostCommand
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
}
