<?php
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'App\Http\Middleware\SetTheme',
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'App\Http\Middleware\VerifyCsrfToken',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth'						=> 'App\Http\Middleware\Authenticate',
		'auth.basic'				=> 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest'						=> 'App\Http\Middleware\RedirectIfAuthenticated',
// module middleware
		'admin'						=> 'App\Modules\Kagi\Http\Middleware\AuthenticateAdmin',
		'throttle'					=> 'App\Modules\Kagi\Http\Middleware\Throttle',
// Locale REDIRECTION MIDDLEWARE
// 		'localize'					=> 'Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes',
// 		'localizationRedirect'		=> 'Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter',
// 		'localeSessionRedirect'		=> 'Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect'
	];

}
