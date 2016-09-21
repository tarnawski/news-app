<?php

namespace News\Command;

use News\DomainModel\PostWasCreated;
use News\AbstractEventNotifier;
use News\AbstractEventProjector;
use News\AbstractEventStore;

class CreatePostCommandHandler
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

    public function handle(CreatePostCommand $createPostCommand)
    {
        $event = new PostWasCreated(
          $createPostCommand->getTitle(),
          $createPostCommand->getContent()
        );

        $this->eventStore->commit($event->serialize());
        $this->eventProjector->project($event);
        $this->eventNotifier->notify($event->serialize());
    }
}