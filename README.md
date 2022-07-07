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
If you will not use it for multiple apps, feel free to create your own implementation in your project directory without forking.

## Example single app

Out of the box we use Redis in order to publish and subscribe. So you need to setup Redis in your app as well.

- Install package `composer require jsonbaby/event-bridge`
- Add an event and listener somewhere in your app

  ```php
  namespace App\Events;

  use DateTimeImmutable;
  use JsonBaby\EventBase\Interfaces\EventInterface;

  final class AcmeEvent implements EventInterface
  {
      public function __construct(
          private DateTimeImmutable $at,
          private string $acmeProperty,
      ) {
      }

      public static function getType(): string
      {
          return 'acme-event';
      }

      public function getAt(): DateTimeImmutable
      {
          return $this->at;
      }

      public function getAcmeProperty(): string
      {
          return $this->acmeProperty;
      }

      public function getData(): array
      {
          return [
              'at' => $this->getAt(),
              'acme_property' => $this->getAcmeProperty()
          ];
      }
  }

  --------

  namespace App\Events;
  
  class AcmeEventListener 
  {
      public function handle(AcmeEvent $event) // AcmeEvent should implement JsonBaby\EventBase\Interfaces\EventInterface
      {
          // deal with AcmeEvent
          $data = $event->getData();
          ...
      }
  }
  ```

- Add the event listener to `config/event-bridge.php`

  ```php
  'listeners' => [
      AcmeEvent::class => [
          AcmeEventListener::class
      ]
  ]
  ```

- Publish your event

  ```php
  use App\Events\AcmeEvent;

  app()->make(EventPubSubInterface::class)->publish('acme-channel', new AcmeEvent(new DateTimeImmutable(), 'acme_property'));
  ```

- Create artisan command and subscribe to a channel in it using snippet bellow. 

  ```php
  app()->make(EventPubSubInterface::class)->subscribe(['acme-channel']);
  ```

## Example multi apps

Out of the box we use Redis in order to publish and subscribe. So you need to setup Redis in your apps as well.

- App 1
  - Install package `composer require jsonbaby/event-bridge`
  - Add your centralized events package to project like `composer require foo/bar-events` or as `git` package

    ```php
    use Foo\Bar\AcmeEvent;
    
    app()->make(EventPubSubInterface::class)->publish('acme-channel', new AcmeEvent(new DateTimeImmutable(), 'acme_property'));
    ```

- App 2
  - Install package `composer require jsonbaby/event-bridge`
  - Add your centralized events package to project like `composer require foo/bar-events` or as `git` package
  - Create an event listener somewhere in your app
    ```php
    namespace App\CrossAppEvents;
    
    use Foo\Bar\AcmeEvent;

    class AcmeEventListener 
    {
        public function handle(AcmeEvent $event) // AcmeEvent should implement JsonBaby\EventBase\Interfaces\EventInterface
        {
            // deal with AcmeEvent
            $data = $event->getData();
            ...
        }
    }
    ```
  - Add the event listener to `config/event-bridge.php`

    ```php
    'listeners' => [
        AcmeEvent::class => [
            AcmeEventListener::class
        ]
    ]

    ```

  - Create artisan command and subscribe to a channel in it using snippet bellow. 
    ```php
    app()->make(EventPubSubInterface::class)->subscribe(['acme-channel']);
    ```
