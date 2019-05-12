<?php

namespace App\Providers;
use App\Usuario;

/**
 * @author Ignacio Martinez Avila
 * Provider mal implementado, creo xD
 */
class AuthCheckProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public static function hasRole($request, $id_rol = null)
    {
    	if(!$id_rol)
    		return ['error' => 'rol no especificado', 'code' => 500];

        $token = $request->header('api_token');
		if(!$token)
			return ['error' => 'token not provided', 'code' => 406];

		$is_admin = false;

		$usuario = Usuario::where('api_token', $token)->first();
		if(!$usuario)
			return ['error' => 'Token invalido', 'code' => 406];

		$roles_usuario = $usuario->roles;
		if(!$roles_usuario)
			return ['error' => 'No tienes permisos, contacta al administrador', 'code' => 401];

		foreach ($roles_usuario as $value)
			if ($value->id == $id_rol)
				$is_admin = true;

		if($is_admin != true)
			return ['error' => 'no tienes los permisos necesarios', 'code' => 401];

		return ['error' => false, 'content' => $roles_usuario];
    }
}