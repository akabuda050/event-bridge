<?php

namespace JsonBaby\EventBridge\Entities;

use JsonBaby\EventBase\Interfaces\EventInterface;
use JsonBaby\EventBridge\Interfaces\EventSerializerInterface;
use SimpleXMLElement;
use Symfony\Component\Serializer\SerializerInterface;

class XmlEventSerializer implements EventSerializerInterface
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function serialize(EventInterface $event): string
    {
        $eventString = $this->serializer->serialize([
            'class' => get_class($event),
            'data' => $event
        ], 'xml');

        return $eventString;
    }

    public function deserialize(string $event): EventInterface
    {
        $eventObject = new SimpleXMLElement($event);
        $eventInstance = $this->serializer->deserialize($eventObject->data->asXml(), $eventObject->class, 'xml');

        return $eventInstance;
    }
}
