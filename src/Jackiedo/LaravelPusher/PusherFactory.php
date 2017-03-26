<?php

/*
 * This file is part of Laravel Pusher.
 *
 * (c) Jackie Do <anhvudo@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jackiedo\LaravelPusher;

use InvalidArgumentException;
use Pusher;

/**
 * This is the Pusher factory class.
 *
 * @author Jackie Do <anhvudo@gmail.com>
 */
class PusherFactory
{
    /**
     * Make a new Pusher client.
     *
     * @param array $config
     *
     * @return \Pusher
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config)
    {
        $keys = [
            'auth_key',
            'secret',
            'app_id',
            'options',
            'host',
            'port',
            'timeout',
        ];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return array_only($config, $keys);
    }

    /**
     * Get the pusher client.
     *
     * @param string[] $auth
     *
     * @return \Pusher
     */
    protected function getClient(array $auth)
    {
        return new Pusher(
            $auth['auth_key'],
            $auth['secret'],
            $auth['app_id'],
            $auth['options'],
            $auth['host'],
            $auth['port'],
            $auth['timeout']
        );
    }
}
