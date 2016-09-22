<?php

namespace CoreDomain\Model;

use Ramsey\Uuid\Uuid;

class PostId
{
    private $value;

    public function __construct($value)
    {
        $this->value = (string) $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public static function generate()
    {
        return new PostId(
            Uuid::uuid4()->toString()
        );
    }
}
