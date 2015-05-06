<?php
namespace Mcamara\LaravelLocalization\Middleware;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Routing\Middleware;

use Closure;
use Config;
use Session;

class LocaleSessionRedirect implements Middleware {

/**
 * Handle an incoming request.
 *
 * @param  \Illuminate\Http\Request $request
 * @param  \Closure $next
 * @return mixed
 */
public function handle(
	$request,
	Closure $next
	)
{

// explode and grab URL data
		$params = explode('/', $request->path());

// Check for hideDefaultLocaleInURL and if we have not Locale in the url
		if ( (app('laravellocalization')->hideDefaultLocaleInURL() == true) && (count($params) > 0) ) {
// Use Larvel to set locale for session
			Session::put('locale', Config::get('app.locale'));
			return $next($request);
		}

// grab locale from URL
		if ( app('laravellocalization')->checkLocaleInSupportedLocales($params[0]) == true ) {
// put URL locale into session
			Session::put('locale', $params[0]);
			return $next($request);
		}
}


}
