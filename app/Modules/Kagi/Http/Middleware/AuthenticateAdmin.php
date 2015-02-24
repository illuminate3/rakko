<?php
namespace App\Modules\Kagi\Http\Middleware;

use Auth;
use Closure;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Routing\Middleware;

class AuthenticateAdmin implements Middleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure                  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
//dd($request);
/*
		if (! Auth::user()->can('manage_admin')) {
			Flash::error('Sorry, you do not have the proper permissions.');

			return new RedirectResponse(url('/'));
		}
*/
		return $next($request);
	}
}
