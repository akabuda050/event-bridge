<?php

namespace JsonBaby\EventBridge\Interfaces\Serializers;

use JsonBaby\EventBase\Interfaces\EventInterface;

interface EventSerializerInterface
{
    public function serialize(EventInterface $event): string;
    public function deserialize(string $event): EventInterface;
}
