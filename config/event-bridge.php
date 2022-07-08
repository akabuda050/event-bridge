<?php

return [
    'serializer' => [
        'entity' => JsonBaby\EventBridge\Entities\JsonEventSerializer::class,
        'provider' => JsonBaby\EventBridge\Entities\SymfonySerializer::class,
    ],

    'event_handler' => JsonBaby\EventBridge\Entities\EventHandler::class,

    'pubsub' =>  [
        'entity' => JsonBaby\EventBridge\Entities\RedisEventPubSub::class,
        'provider' => JsonBaby\EventBridge\Entities\RedisConnection::class
    ],

    'listeners' => [
        // Define events and listeners here.
        // e.g.
        //  Event::class => [
        //      EventListener1::class,
        //      EventListener2::class,
        //      ...
        //  ]
    ]
];
