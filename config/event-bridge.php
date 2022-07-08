<?php

return [
    'serializer' => [
        'entity' => JsonBaby\EventBridge\Entities\Serializers\JsonEventSerializer::class,
        'provider' => JsonBaby\EventBridge\Entities\Serializers\SymfonySerializer::class,
    ],

    'event_handler' => JsonBaby\EventBridge\Entities\EventHandler::class,

    'pubsub' =>  [
        'entity' => JsonBaby\EventBridge\Entities\EventPubSub::class,
        'provider' => JsonBaby\EventBridge\Entities\Connections\RedisConnection::class
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
