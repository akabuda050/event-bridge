<?php

namespace JsonBaby\EventBridge\Entities;

use JsonBaby\EventBase\Interfaces\EventInterface;
use JsonBaby\EventBridge\Interfaces\EventHandlerInterface;
use JsonBaby\EventBridge\Interfaces\EventPubSubInterface;
use JsonBaby\EventBridge\Interfaces\Serializers\EventSerializerInterface;
use JsonBaby\EventBridge\Interfaces\Connections\PubSubConnectionInterface;

class EventPubSub implements EventPubSubInterface
{
    public function __construct(
        private PubSubConnectionInterface $connection,
        private EventSerializerInterface $eventSerializer,
        private EventHandlerInterface $eventHandler
    ) {
    }

    public function publish(string $channel, EventInterface $event): void
    {
        $this->connection->publish($channel, $this->eventSerializer->serialize($event));
    }

    public function subscribe(array $channels): void
    {
        $this->connection->subscribe($channels, function ($message, $channel) {
            $this->eventHandler->handle($this->eventSerializer->deserialize($message), $channel);
        });
    }
}
