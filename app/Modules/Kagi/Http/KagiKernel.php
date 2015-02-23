<?php
namespace App\Modules\Kagi\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
//use app\Http\Kernel as Kernel;

//class KagiKernel extends Kernel {
class KagiKernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
/*
*/
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
/*
		'auth' => 'App\Modules\Kagi\Http\Middleware\Authenticate',
		'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest' => 'App\Modules\Kagi\Http\Middleware\RedirectIfAuthenticated',
*/
//		'admin' => 'App\Modules\Kagi\Http\Middleware\AuthenticateAdmin',
//		'throttle' => 'App\Modules\Kagi\Http\Middleware\Throttle',
	];

}
