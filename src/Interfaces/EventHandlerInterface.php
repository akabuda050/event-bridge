<?php

namespace JsonBaby\EventBridge\Interfaces;

use JsonBaby\EventBase\Interfaces\EventInterface;

interface EventHandlerInterface
{
    public function handle(EventInterface $event, string $channel);
}
