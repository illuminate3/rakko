<?php namespace Mcamara\LaravelLocalization\Middleware;

use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Http\RedirectResponse;
use Closure;
use Session;

class LocaleSessionRedirect implements Middleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
//dd($request);

// check to see if redirect is already the same as the locale
// if true don't waste cpu cycles
if ( $request->path() == session('locale') ) {

dd($request->path());

	return $next($request);
}

//dd(app('laravellocalization')->hideDefaultLocaleInURL());

//dd(session('locale'));
//dd(app('laravellocalization')->getDefaultLocale());

        $params = explode('/', $request->path());

if ( app('laravellocalization')->hideDefaultLocaleInURL() == true ) {
//dd('loaded');
//dd(app('laravellocalization')->getDefaultLocale());
//dd(app('laravellocalization')->setLocale(app('laravellocalization')->getDefaultLocale()));
Session::put('locale', app('laravellocalization')->getDefaultLocale());

	app('laravellocalization')->setLocale(app('laravellocalization')->getDefaultLocale());
	return $next($request);
} else {

	if ( app('laravellocalization')->checkLocaleInSupportedLocales($request->path()) == true ) {


// check to see if the switch local = default locale && check if hideDefaultLocaleInURL == true
// We want to test for the config setting

dd($request->path());

//Session::put('locale', $request->path());
	app('laravellocalization')->setLocale($request->path());
	return $next($request);


} else {
	return $next($request);
}
}

//dd($params);

//dd($request->path());
// "/'"

//dd($params[ 0 ]);
// 2

//dd(count($params));
// 2

//dd(app('laravellocalization')->checkLocaleInSupportedLocales($request->path()));


        if ( count($params) > 0 && $locale = app('laravellocalization')->checkLocaleInSupportedLocales($params[ 0 ]) )
        {
// dd($locale);
// true

// dd($params[ 0 ]);
// true
            session([ 'locale' => $params[ 0 ] ]);

            return $next($request);
        }

        $locale = session('locale', false);
//dd($locale);
// es

        if ( $locale && !( app('laravellocalization')->getDefaultLocale() === $locale && app('laravellocalization')->hideDefaultLocaleInURL() ) )
        {
//dd($locale);
// es

//dd(app('laravellocalization')->getDefaultLocale());
// en

//dd(app('laravellocalization')->hideDefaultLocaleInURL());
// true

            app('session')->reflash();
// dd(app('session')->reflash());
// null

            $redirection = app('laravellocalization')->getLocalizedURL($locale);
// dd($redirection);
// http://l5.local/es

            return new RedirectResponse($redirection, 302, [ 'Vary', 'Accept-Language' ]);
        }

        return $next($request);
    }
}
