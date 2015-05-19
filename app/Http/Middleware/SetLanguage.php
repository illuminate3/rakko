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
use Lang;
use Session;

class SetLanguage implements Middleware {

	public function __construct(
		Application $app,
		Redirector $redirector,
		Request $request
		){
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
	public function handle($request, Closure $next)
	{

if ( !(Session::has('locale')) ) {
//dd('die');
	Session::put('locale', Config::get('app.locale'));
// 	App::setLocale( Config::get('app.locale') );
// 	Lang::setLocale( Config::get('app.locale') );
}


// $params = explode('/', $request->path());
//
//
// //
// if ( $params[0] === 'language' ) {
// $lang = $params[1];
// //dd('die');
// //dd($lang);
// //dd($lang);
// //
// Session::forget('locale');
// //
// //
// 		Session::put('locale', $lang);
// //		App::setLocale(Session::get('locale'));
// //		LaravelLocalization::setLocale($lang);
// 		$this->app->setLocale($lang);
//
// 		App::setLocale($lang);
// // 		Lang::setLocale($lang);
// //App::setLocale('en');
// //
//
// // App::setLocale($lang);
//
// }



return $next($request);

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
