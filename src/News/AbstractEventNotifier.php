<?php

namespace News;

interface AbstractEventNotifier
{
    public function notify($data);
}