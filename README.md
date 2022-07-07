# Very short description of the package

This package provides basic interfaces for event publishing and subscribing to it.

## Installation

`composer require jsonbaby/event-bridge`

## Usage
In order to get this work you should have a centralized store of your events(package, repository, etc), so you can use it between your applications.(for communication between multiple apps).

All events should implement `JsonBaby\EventBase\Interfaces\EventInterface` from [EventBase package](https://packagist.org/packages/jsonbaby/events-base "EventBase package")
Events will be handled by an event handler that takes listeners from `config/event-bridge.php`. So you can add your listeners to config. This is very similar to adding laravel one.

This `config/event-bridge.php` contains other configs required by `EventBridgeServiceProvider` in case you want to build your own things based on contracts defined in this package.

**NOTE:** if you will use this package for multiple applications should have the same classes of events and serializers, etc in order to have correct communication.
For example: you can not use `XmlSerializer` for serialization in app1 and `JsonSerializer` in app2 for deserialization.
So if you want to build your own stuff based on this package you can fork this one, add things and use your package in your apps instead of this one.
If you will not use it for multiply apps, feel free to create your own implementation in your project directory without forking.
