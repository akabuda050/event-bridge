<?php

namespace JsonBaby\EventBridge\Interfaces;

use JsonBaby\EventBase\Interfaces\EventInterface;

interface EventPubSubInterface
{
    public function publish(string $channel, EventInterface $event): void;
    public function subscribe(array $channels): void;
}
