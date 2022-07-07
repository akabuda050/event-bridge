<?php

namespace JsonBaby\EventBridge\Interfaces;

use Closure;

interface PubSubConnectionInterface {
    public function publish(string $channel, string $data);
    public function subscribe(array $channels, Closure $callback);
}