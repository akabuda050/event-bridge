<?php

namespace JsonBaby\EventBridge\Tests\Unit;

use JsonBaby\EventBridge\EventBridgeServiceProvider;
use JsonBaby\EventBridge\Interfaces\EventHandlerInterface;
use JsonBaby\EventBridge\Interfaces\EventPubSubInterface;
use JsonBaby\EventBridge\Interfaces\EventSerializerInterface;
use JsonBaby\EventBridge\Interfaces\PubSubConnectionInterface;
use JsonBaby\EventBridge\Tests\TestCase;
use stdClass;

class EventBridgeServiceProviderTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            EventBridgeServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app->config->set('event-bridge.listeners', [
            stdClass::class => [
                stdClass::class
            ]
        ]);

        $app->config->set('event-bridge.pubsub.entity', stdClass::class);
        $app->config->set('event-bridge.pubsub.provider', stdClass::class);

        $app->config->set('event-bridge.serializer.entity', stdClass::class);
        $app->config->set('event-bridge.serializer.provider', stdClass::class);

        $app->config->set('event-bridge.event_handler', stdClass::class);
    }

    /** @test */
    public function it_can_use_listeners_from_config()
    {
        self::assertSame(
            [
                stdClass::class => [
                    stdClass::class
                ]
            ],
            $this->app->config['event-bridge.listeners']
        );
    }

    /** @test */
    public function it_can_resolve_serializer()
    {
        self::assertInstanceOf(
            stdClass::class,
            $this->app->make(EventSerializerInterface::class)
        );
    }

    /** @test */
    public function it_can_resolve_pubsub_connection()
    {
        self::assertInstanceOf(
            stdClass::class,
            $this->app->make(PubSubConnectionInterface::class)
        );
    }


    /** @test */
    public function it_can_resolve_pub_sub()
    {
        self::assertInstanceOf(
            stdClass::class,
            $this->app->make(EventPubSubInterface::class)
        );
    }

    /** @test */
    public function it_can_resolve_event_handler()
    {
        self::assertInstanceOf(
            stdClass::class,
            $this->app->make(EventHandlerInterface::class)
        );
    }
}
