<?php

namespace JsonBaby\EventBridge\Entities;

use Closure;
use Illuminate\Contracts\Redis\Connection;
use JsonBaby\EventBridge\Interfaces\PubSubConnectionInterface;

class RedisConnection implements PubSubConnectionInterface
{
    public function __construct(
        private Connection $connection
    ) {
    }

    public function publish(string $channel, string $data): void
    {
        $this->connection->publish($channel, $data);
    }

    public function subscribe(array $channels, Closure $callback): void
    {
        $this->connection->subscribe($channels, $callback);
    }
}