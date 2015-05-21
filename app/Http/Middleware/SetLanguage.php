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

	public function __construct(Request $request)
	{
		$this->request = $request;

// fix for setting App::locale
		$lang = Session::get('locale');
		if ($lang != null) {
//			\App::setLocale($lang);
//\App::setLocale(Session::get('locale'));
		}
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
			Session::put('locale', Config::get('app.locale'));
		}

		return $next($request);
	}


}
