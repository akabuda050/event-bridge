<?php

namespace JsonBaby\EventBridge\Entities\Connections;

use Closure;
use Illuminate\Contracts\Redis\Connection;
use JsonBaby\EventBridge\Interfaces\Connections\PubSubConnectionInterface;

class RedisConnection implements PubSubConnectionInterface
{
    private Connection $connection;

    public function __construct()
    {
        $this->connection = app()->make('redis.connection');
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
