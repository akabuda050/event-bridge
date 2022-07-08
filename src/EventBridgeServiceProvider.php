<?php

namespace JsonBaby\EventBridge;

use Illuminate\Support\ServiceProvider;
use JsonBaby\EventBridge\Console\InstallEventBridgeCommand;
use JsonBaby\EventBridge\Interfaces\EventPubSubInterface;
use JsonBaby\EventBridge\Interfaces\EventHandlerInterface;
use JsonBaby\EventBridge\Interfaces\Connections\PubSubConnectionInterface;
use JsonBaby\EventBridge\Interfaces\Serializers\EventSerializerInterface;

class EventBridgeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/event-bridge.php' => config_path('event-bridge.php'),
            ], 'event-bridge-config');

            $this->commands([
                InstallEventBridgeCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/event-bridge.php', 'event-bridge');

        // Register the main class to use with the facade

        $this->app->singleton(PubSubConnectionInterface::class, function ($app) {
            return new $app->config['event-bridge.pubsub.provider']();
        });

        $this->app->singleton(EventSerializerInterface::class, function ($app) {
            return new $app->config['event-bridge.serializer.entity'](
                $app->make($app->config['event-bridge.serializer.provider'])
            );
        });

        $this->app->singleton(EventHandlerInterface::class, function ($app) {
            return new $app->config['event-bridge.event_handler'](
                $app->config['event-bridge.listeners']
            );
        });

        $this->app->singleton(EventPubSubInterface::class, function ($app) {
            return new $app->config['event-bridge.pubsub.entity'](
                $app->make(PubSubConnectionInterface::class),
                $app->make(EventSerializerInterface::class),
                $app->make(EventHandlerInterface::class)
            );
        });
    }
}
