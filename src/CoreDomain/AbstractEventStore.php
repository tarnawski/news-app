<?php

namespace CoreDomain;

interface AbstractEventStore
{
    public function commit($event);
}
