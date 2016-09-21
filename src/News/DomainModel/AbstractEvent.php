<?php

namespace News\DomainModel;

interface AbstractEvent
{
    public function serialize();
}