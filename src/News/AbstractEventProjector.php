<?php

namespace News;

interface AbstractEventProjector
{
    public function project($event);
}