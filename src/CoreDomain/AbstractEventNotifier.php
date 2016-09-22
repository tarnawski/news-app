<?php

namespace CoreDomain;

interface AbstractEventNotifier
{
    public function notify($data);
}
