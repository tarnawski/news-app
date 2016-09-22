<?php

namespace CoreDomain\Command;

use Common\PostWasCreated;
use CoreDomain\AbstractEventNotifier;
use CoreDomain\AbstractEventProjector;
use CoreDomain\AbstractEventStore;
use CoreDomain\Model\PostId;

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
            PostId::generate()->getValue(),
            $createPostCommand->getTitle(),
            $createPostCommand->getContent()
        );

        $this->eventStore->commit($event->serialize());
        $this->eventProjector->project($event);
        $this->eventNotifier->notify($event->serialize());
    }
}
