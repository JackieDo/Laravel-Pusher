<?php namespace Jackiedo\LaravelPusher;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use Pusher;

/**
 * This is the Pusher service provider class.
 *
 * @author Jackie Do <anhvudo@gmail.com>
 */
class PusherServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        /**
         * Publishing package's config
         */
        $packageConfigPath = __DIR__ . '/../../config/config.php';
        $config            = config_path('pusher.php');

        $this->publishes([
            $packageConfigPath => $config,
        ], 'config');

        if (file_exists($config)) {
            $this->mergeConfigFrom($packageConfigPath, 'pusher');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->singleton('pusher.factory', function () {
            return new PusherFactory();
        });

        $this->app->alias('pusher.factory', PusherFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('pusher', function (Container $app) {
            $config = $app['config'];
            $factory = $app['pusher.factory'];

            return new PusherManager($config, $factory);
        });

        $this->app->alias('pusher', PusherManager::class);
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('pusher.connection', function (Container $app) {
            $manager = $app['pusher'];

            return $manager->connection();
        });

        $this->app->alias('pusher.connection', Pusher::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'pusher',
            'pusher.factory',
            'pusher.connection',
        ];
    }
}
