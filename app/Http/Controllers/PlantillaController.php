<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plantilla;

class PlantillaController extends Controller
{
	public function __construct(){

	}

	public function validar_plantilla($request){
		$reglas = [ 'archivo' => 'required' ];
		$this->validate($request, $reglas);
	}
	
	public function index(){
		// Eloquent
		$plantillas = Plantilla::all();
		return response()->json( $plantillas, 200 );
	}

	public function store(Request $request){
		if (!$request->hasFile('archivo'))
			return $this->error_response('No haz enviado el archivo', 401);

		// $request->file('photo')->move($destinationPath, $fileName);
		// falta checar si el archivo ya fue subido, para poner otro nombre. O generar un nombre random c:
		$filename = 'plantilla2.json';
		$request->file('archivo')->move('../storage/app/plantillas', $filename);

		$plantilla = Plantilla::create([
			'archivo' => $filename
		]);

		if(!$plantilla)
			return $this->error_response('No se puede crear con esos parámetros', 401);

		// si se crea, lo devuelvo para que el front pueda hacer cosas con ello
		return $this->_response( $plantilla, 201);
	}
	
}
