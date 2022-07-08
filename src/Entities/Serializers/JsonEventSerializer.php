<?php

namespace JsonBaby\EventBridge\Entities\Serializers;

use JsonBaby\EventBase\Interfaces\EventInterface;
use JsonBaby\EventBridge\Interfaces\Serializers\SerializerInterface;
use JsonBaby\EventBridge\Interfaces\Serializers\EventSerializerInterface;

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
