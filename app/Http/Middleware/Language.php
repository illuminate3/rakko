<?php
namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Routing\Middleware;

use App;
use Closure;
use Config;
use Redirect;

class Language implements Middleware {

	public function __construct(Application $app, Redirector $redirector, Request $request) {
		$this->app = $app;
		$this->redirector = $redirector;
		$this->request = $request;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
// 	public function handle($request, Closure $next)
// 	{
// 		// Make sure current locale exists.
// 		$locale = $request->segment(1);
// 		if ( ! array_key_exists($locale, $this->app->config->get('app.locales'))) {
// 			$segments = $request->segments();
// 			$segments[0] = $this->app->config->get('app.fallback_locale');
// 			return $this->redirector->to(implode('/', $segments));
// 		}
// 		$this->app->setLocale($locale);
// 		return $next($request);
// 	}
	public function handle($request, Closure $next)
	{
		// Make sure current locale exists.
// 		$locale = $request->segment(1);
//
// 		if ( ! array_key_exists($locale, Config::get('app.locales'))) {
// 			$segments = $request->segments();
// 			$segments[0] = Config::get('app.fallback_locale');
//
// 			return Redirect::to(implode('/', $segments));
// 		}
//
// 		App::setLocale($locale);
//
// 		return $next($request);


// 	$locale = $request->route('locale');
// 	Localization::setLocale($locale);
// 	return $next($request);

	}


}
