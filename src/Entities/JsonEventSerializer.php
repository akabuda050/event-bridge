<?php

namespace JsonBaby\EventBridge\Entities;

use JsonBaby\EventBase\Interfaces\EventInterface;
use JsonBaby\EventBridge\Interfaces\EventSerializerInterface;
use JsonBaby\EventBridge\Interfaces\SerializerInterface;

class JsonEventSerializer implements EventSerializerInterface
{
    public function __construct(private SerializerInterface $serializer)
    {
    }
    
    public function serialize(EventInterface $event): string
    {
        $eventString = $this->serializer->serialize($event, 'json');

        return json_encode([
            'class' => get_class($event),
            'data' => $eventString,
        ]);
    }

    public function deserialize(string $event): EventInterface
    {
        $eventObject = json_decode($event, true);
        $eventInstance = $this->serializer->deserialize($eventObject['data'], $eventObject['class'], 'json');
        
        return $eventInstance;
    }
}
