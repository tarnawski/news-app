<?php

namespace CoreDomainBundle\Service;

use CoreDomain\AbstractEventStore;

class EventStoreService implements AbstractEventStore
{
    const FILE_NAME = 'event_storage.data';

    private $rootDir;

    public function __construct($rootDir)
    {
        $this->rootDir = $rootDir;
    }

    public function commit($eventBody)
    {
        $path = sprintf('%s/../%s', $this->rootDir, self::FILE_NAME);
        $fp = fopen($path, 'a');
        fwrite($fp, $eventBody);
        fwrite($fp, "\n");
        fclose($fp);
    }
}
