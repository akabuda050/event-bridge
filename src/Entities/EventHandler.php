<?php

namespace JsonBaby\EventBridge\Entities;

use JsonBaby\EventBridge\Interfaces\EventHandlerInterface;
use JsonBaby\EventBase\Interfaces\EventInterface;

class EventHandler implements EventHandlerInterface
{

    public function __construct(private array $handlers)
    {
    }

    public function handle(EventInterface $event, $channel)
    {
        $class = get_class($event);
        if (isset($this->handlers[$class])) {
            foreach ($this->handlers[$class] as $handler) {
                (new $handler())->handle($event);
            };
        }
    }
}
