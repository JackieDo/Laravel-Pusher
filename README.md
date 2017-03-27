[![Latest Stable Version](https://poser.pugx.org/jackiedo/laravel-pusher/v/stable)](https://packagist.org/packages/jackiedo/laravel-pusher)
[![Total Downloads](https://poser.pugx.org/jackiedo/laravel-pusher/downloads)](https://packagist.org/packages/jackiedo/laravel-pusher)
[![Latest Unstable Version](https://poser.pugx.org/jackiedo/laravel-pusher/v/unstable)](https://packagist.org/packages/jackiedo/laravel-pusher)
[![License](https://poser.pugx.org/jackiedo/laravel-pusher/license)](https://packagist.org/packages/jackiedo/laravel-pusher)

# Description

Laravel Pusher is a [Pusher](https://pusher.com/) bridge for Laravel from version 5.1 to 5.4 using [the Official Pusher package](https://github.com/pusher/pusher-http-php).

This package is forked from [vinkla/laravel-pusher](https://github.com/vinkla/laravel-pusher) package for supporting Laravel 5.4 using php version earlier 7.x

# Overview
Look at one of the following topics to learn more about Laravel Pusher.

* [Installation](#installation)
* [Configuration](#configuration)
    - [Default Connection Name](#default-connection-name)
    - [Pusher Connections](#pusher-connections)
* [Usage](#usage)
    - [PusherManager](#pushermanager)
    - [Pusherer facade](#pusherer-facade)
    - [PusherServiceProvider](#pusherserviceprovider)
    - [Examples](#examples)
* [Official Documentation](#official-documentation)

## Installation

- First, require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
$ composer require jackiedo/laravel-pusher
```

- Once update operation completes, the second step is add the service provider. Open `config/app.php`, and add a new item to the providers array:

```php
...
'providers' => array(
    ...
    Jackiedo\LaravelPusher\PusherServiceProvider::class,
),
```

- The third step is add the follow line to the section `aliases` in file `config/app.php`:

```php
'Pusherer' => Jackiedo\LaravelPusher\Facades\Pusherer::class,
```

## Configuration

Laravel Pusher requires connection configuration. To get started, you'll need to publish configuration file:

```bash
$ php artisan vendor:publish --provider="Jackiedo\LaravelPusher\PusherServiceProvider" --tag="config"
```

This will create a `config/pusher.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

#### Default Connection Name

This option `default` is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `main`.

#### Pusher Connections

This option `connections` is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.

## Usage

#### PusherManager

This is the class of most interest. It is bound to the ioc container as `pusher` and can be accessed using the `Facades\Pusherer` facade. This class implements the ManagerInterface by extending AbstractManager. The interface and abstract class are both part of [Graham Campbell's](https://github.com/GrahamCampbell) [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at that repository. Note that the connection class returned will always be an instance of `Pusher`.

#### Pusherer facade

This facade will dynamically pass static method calls to the `pusher` object in the ioc container which by default is the `PusherManager` class.

#### PusherServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

#### Examples

Here you can see an example of just how simple this package is to use. Out of the box, the default adapter is `main`. After you enter your authentication details in the config file, it will just work:

```php
Pusherer::trigger('my-channel', 'my-event', ['message' => $message]);
// We're done here - how easy was that, it just works!

Pusherer::getSettings();
// This example is simple and there are far more methods available.
```

The Pusher manager will behave like it is a `Pusher`. If you want to call specific connections, you can do that with the connection method:

```php
// Writing this…
Pusherer::connection('main')->log('They see me logging…');

// …is identical to writing this
Pusherer::log('They hatin…');

// and is also identical to writing this.
Pusherer::connection()->log('Tryin to catch me testing dirty…');

// This is because the main connection is configured to be the default.
Pusherer::getDefaultConnection(); // This will return main.

// We can change the default connection.
Pusherer::setDefaultConnection('alternative'); // The default is now alternative.
```

If you prefer to use dependency injection over facades like me, then you can inject the manager:

```php
use Jackiedo\LaravelPusher\PusherManager;

class Foo
{
    protected $pusher;

    public function __construct(PusherManager $pusher)
    {
        $this->pusher = $pusher;
    }

    public function bar()
    {
        $this->pusher->trigger('my-channel', 'my-event', ['message' => $message]);
    }
}

App::make('Foo')->bar();
```

## Official Documentation

There are other classes in this package that are not documented here. This is because the package is a Laravel wrapper of [the Official Pusher package](https://github.com/pusher/pusher-http-php).
