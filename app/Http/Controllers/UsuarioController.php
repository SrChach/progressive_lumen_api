<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		
	}

	/*
		public function index(Request $request){
			// requiere peticiones en JSON
			if(!$request->isJson())
				return response()->json(['error' => 'unauthorized'], 401);

			// Eloquent
			$users = User::all();
			return response()->json( $users, 200 );
		}

		public function store(Request $request){
			if(!$request->isJson())
				return response()->json(['err' => 'unauthorized'], 401);

			$data = $request->json()->all();		

			$usuario = User::create([
				'name' => $data['name'],
				'username' => $data['username'],
				'email' => $data['email'],
				'password' => Hash::make($data['password']),
				'api_token' => str_random(60)
			]);

			// si se crea, lo devuelvo para que el front pueda hacer cosas con ello
			return response()->json( $usuario, 201);
		}
	*/

	public function getToken(Request $request){
		$data = $request->all();

		$user = Usuario::where('username', $data['username'])->first();
		if(!$user)
			return response()->json(['error' => 'user not found'], 406);

		if($user && Hash::check($data['password'], $user->password)){
			return response()->json(['content' => ['status' => 'successful', 'api_token' => $user->api_token, 'roles' => $user->roles] ], 200);
		}

		return response()->json(['error' => 'Password incorrect'], 406);
	}
}
