<?php namespace Jackiedo\LaravelPusher\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the Pusher facade class.
 *
 * @author Jackie Do <anhvudo@gmail.com>
 */
class Pusherer extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'pusher';
    }
}
