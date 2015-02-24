<?php
namespace App\Modules\Kagi\Http\Middleware;

use Closure;
use GrahamCampbell\Throttle\Facades\Throttle;
use Illuminate\Contracts\Routing\Middleware;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class Throttle implements Middleware
{

	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \Closure                 $next
	 *
	 * @throws \Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException
	 *
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$limit = 10; // request limit

		$time = 30; // ban time

		if (!Throttle::attempt($request, $limit, $time)) {
			throw new TooManyRequestsHttpException($time * 60, 'Rate limit exceed.');
		}

		return $next($request);
	}

}
