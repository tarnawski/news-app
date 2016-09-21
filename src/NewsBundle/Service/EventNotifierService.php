<?php

namespace NewsBundle\Service;

use Kafka\Produce;
use News\AbstractEventNotifier;

class EventNotifierService implements AbstractEventNotifier
{
    /**
     * @var string
     */
    private $topic;

    /**
     * @var Produce
     */
    private $produce;

    public function __construct($kafka_topic, Produce $produce)
    {
        $this->topic = $kafka_topic;
        $this->produce = $produce;
    }

    public function notify($event)
    {
        $this->produce->setRequireAck(-1);
        $this->produce->setMessages($this->topic, 0, $event);
        $result =  $this->produce->send();

        return ($result[$this->topic][0]['errCode'] == 0) ? true : false;
    }
}
