<?php

namespace CoreDomain\Command;

use Common\PostWasRemoved;
use CoreDomain\AbstractEventNotifier;
use CoreDomain\AbstractEventProjector;
use CoreDomain\AbstractEventStore;

class DeletePostCommandHandler
{
    private $eventStore;
    private $eventNotifier;
    private $eventProjector;

    public function __construct(
        AbstractEventStore $eventStore,
        AbstractEventNotifier $eventNotifier,
        AbstractEventProjector $eventProjector
    ) {
        $this->eventStore = $eventStore;
        $this->eventNotifier = $eventNotifier;
        $this->eventProjector = $eventProjector;
    }

    public function handle(DeletePostCommand $deletePostCommand)
    {
        $event = new PostWasRemoved($deletePostCommand->getUuid());

        $this->eventStore->commit($event->serialize());
        $this->eventProjector->project($event);
        $this->eventNotifier->notify($event->serialize());
    }
}
