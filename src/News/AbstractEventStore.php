<?php

namespace News;

interface AbstractEventStore
{
    public function commit($event);
}