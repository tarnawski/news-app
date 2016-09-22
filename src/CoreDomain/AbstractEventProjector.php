<?php

namespace CoreDomain;

interface AbstractEventProjector
{
    public function project($event);
}
