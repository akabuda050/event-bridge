# Very short description of the package

This package provides basic interfaces for event publishing between multiple applications.

## Installation

`composer install`

## Testing

`composer test ./tests`

## Usage
In order to get this work you should have centralized store of your events(package, repository, etc), so you can use it between your applications.
Those events should implement `JsonBaby\EventBase\Interfaces\EventInterface` from [EventBase package](https://packagist.org/packages/jsonbaby/events-base "EventBase package")
Events will be handled by event handler that takes listeners from `config/event-bridge.php`.

This `config/event-bridge.php` contains other configs required by `EventBridgeServiceProvider` in case you want to build your own things based on contracts defined in this package. NOTE: all applications should have the same classes of events and serializers, etc in order have correct communication.
For example: you can not use `XmlSerializer` for serialization in app1 and `JsonSerializer` in app2 for deserialization
