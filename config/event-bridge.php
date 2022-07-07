<?php

return [
    'serializer' => [
        'entity' => JsonBaby\EventBridge\Entities\JsonEventSerializer::class,
        'provider' => [
            // See https://symfony.com/doc/current/components/serializer.html
            'contract' => Symfony\Component\Serializer\SerializerInterface::class,
            'concrete' => [
                'entity' => Symfony\Component\Serializer\Serializer::class,
                'encoders' => [
                    Symfony\Component\Serializer\Encoder\JsonEncoder::class,
                    Symfony\Component\Serializer\Encoder\XmlEncoder::class
                ],
                'normalizers' => [
                    Symfony\Component\Serializer\Normalizer\ObjectNormalizer::class
                ]
            ],
        ]
    ],

    'event_handler' => JsonBaby\EventBridge\Entities\EventHandler::class,

    'pubsub' =>  [
        'entity' => JsonBaby\EventBridge\Entities\RedisEventPubSub::class,
        'connection' => [
            'entity' => JsonBaby\EventBridge\Entities\RedisConnection::class,
            'provider' => 'redis.connection'
        ],
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
