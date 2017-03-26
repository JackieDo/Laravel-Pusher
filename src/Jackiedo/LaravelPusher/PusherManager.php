<?php namespace Jackiedo\LaravelPusher;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * This is the Pusher manager class.
 *
 * @author Jackie Do <anhvudo@gmail.com>
 */
class PusherManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \Jackiedo\LaravelPusher\PusherFactory
     */
    private $factory;

    /**
     * Create a new Pusher manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Jackiedo\LaravelPusher\PusherFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, PusherFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return \Pusher
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'pusher';
    }

    /**
     * Get the factory instance.
     *
     * @return \Jackiedo\LaravelPusher\PusherFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
