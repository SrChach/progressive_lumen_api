<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plantilla;
use App\Plantillacampo;

class PlantillaCampoController extends Controller
{
	public function __construct(){

	}
	
	public function index($id_plantilla){
		$plantilla = Plantilla::find($id_plantilla);
		$campos = $plantilla->plantillacampos;
		return response()->json( $campos, 200 );
	}

	public function store(Request $request){
		// return response('true');
		$plantilla = Plantillacampo::create([
			'palabraClave' => 'nombre_curso',
			'nombreCampo' => str_random(32),
			'vecesRepite' => '1',
			'isImage' => 0,
			'plantilla_id' => 1
		]);

		return response()->json($plantilla);
	}
	
}
