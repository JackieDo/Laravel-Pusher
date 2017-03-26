<?php

/*
 * This file is part of Laravel Pusher.
 *
 * (c) Jackie Do <anhvudo@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jackiedo\LaravelPusher\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the Pusher facade class.
 *
 * @author Jackie Do <anhvudo@gmail.com>
 */
class Pusher extends Facade
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
