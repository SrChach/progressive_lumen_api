<?php

namespace App\Http\Middleware;

use Closure;
use App\Providers\AuthCheckProvider;

class Profesor
{
	
	/**
	 * Create a new middleware instance.
	 */
	public function __construct()
	{
		
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = null)
	{
		$checked = AuthCheckProvider::hasRole($request, 2);
		if($checked['error'] != false)
			return response()->json([ 'error' => $checked['error'] ], $checked['code'] );

		// deja pasar la acción si no se incumple nada arriba
		return $next($request);
	}
}
