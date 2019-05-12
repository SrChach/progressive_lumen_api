<?php

namespace App\Http\Middleware;

use Closure;
use App\Usuario;

class Administrador
{
	

	/**
	 * Create a new middleware instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Factory  $auth
	 * @return void
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
		$token = $request->header('api_token');
		if(!$token)
			return response()->json(['error' => 'token not provided']);

		$is_admin = false;

		$usuario = Usuario::where('api_token', $token)->first();
		if(!$usuario)
			return response()->json(['error' => "Token inválido"], 406);

		$roles_usuario = $usuario->roles;
		if(!$roles_usuario)
			return response()->json(['error' => 'No tienes permisos, contacta al administrador'], 401);

		foreach ($roles_usuario as $value)
			if ($value->id == 1)
				$is_admin = true;

		if($is_admin != true)
			return response()->json(["error" => "no tienes los permisos necesarios"], 401);

		// deja pasar la acción si no se incumple nada arriba
		return $next($request);
	}
}
