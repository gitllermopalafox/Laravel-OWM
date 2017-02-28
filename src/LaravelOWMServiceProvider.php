<?php
namespace Gmopx\LaravelOWM;

use Illuminate\Support\ServiceProvider;

class LaravelOWMServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$config = $this->app['config']->get('laravel-owm');

		// Loading routes file
		if ($config !== null) {

			if ($config['routes_enabled']) {
				require __DIR__ . '/Http/routes.php';
			}

		} else {
			require __DIR__ . '/Http/routes.php';
		}

		$this->publishes([
			__DIR__ . '/config' => config_path()
		]);

	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('Gmopx\LaravelOWM\LaravelOWM', function(){

			return new \Gmopx\LaravelOWM\LaravelOWM();

		});
	}

}
