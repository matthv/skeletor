<?php

namespace Matthv\Skeletor;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

/**
 * Class SkeletorServiceProvider
 * @package Matthv\Skeletor
 * php artisan vendor:publish --provider="Matthv\Skeletor\SkeletorServiceProvider"
 */
class SkeletorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

	/**
	 * @var string
	 */
    protected $custom_route_file_published	= '/routes/skeletor/custom.php';

    /**
     * Bootstrap the application events.
     *
     * @return void
	 *
     */
    public function boot() {
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'skeletor');
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'skeletor');

		$this->publishes([__DIR__ . '/../config/config.php' => config_path('skeletor.php')], 'config');
        $this->publishes([__DIR__ . '/../resources/lang' => resource_path('lang')], 'lang');
        $this->publishes([__DIR__ . '/../resources/views' => resource_path('views/vendor/skeletor')], 'views');
        $this->publishes([__DIR__ . '/../public' => public_path('vendor/skeletor')], 'public');
		$this->publishes([__DIR__ . '/../routes/custom.php' => base_path() . $this->custom_route_file_published], 'custom_routes');

		$this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

		if (file_exists(base_path() . $this->custom_route_file_published)) {
			$this->loadRoutesFrom(base_path() . $this->custom_route_file_published);
		}

		app()->router->pushMiddlewareToGroup(config('skeletor.middleware_auth'), \Matthv\Skeletor\Http\Middleware\Admin::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
		$this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'skeletor');
		$this->mergeConfigFrom(__DIR__ . '/../config/auth.php', 'auth');
    }

	/**
	 * Merge the given configuration with the existing configuration.
	 *
	 * @param  string  $path
	 * @param  string  $key
	 * @return void
	 */
	protected function mergeConfigFrom($path, $key)
	{
		$config = $this->app['config']->get($key, []);
		$this->app['config']->set($key, $this->mergeConfig(require $path, $config));
	}
	/**
	 * Merges the configs together and takes multi-dimensional arrays into account.
	 *
	 * @param  array  $original
	 * @param  array  $merging
	 * @return array
	 */
	protected function mergeConfig(array $original, array $merging)
	{
		$array = array_merge($original, $merging);
		foreach ($original as $key => $value) {
			if (! is_array($value)) {
				continue;
			}
			if (! Arr::exists($merging, $key)) {
				continue;
			}
			if (is_numeric($key)) {
				continue;
			}
			$array[$key] = $this->mergeConfig($value, $merging[$key]);
		}
		return $array;
	}

}
