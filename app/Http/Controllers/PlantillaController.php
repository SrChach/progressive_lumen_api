<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plantilla;

class PlantillaController extends Controller
{
	public function __construct(){

	}

	/*
		Proceso nueva plantilla:
			Subir plantilla --
			renombrarla --
			guardarla --
			Guardar el nombre de la plantilla --
			subir sus campos, y cómo se llaman. Generar llave random que se pondrá en cada campo como llave xd

			cambiar el texto template por la llave en el documento
			Guardar las llaves en la base de datos

		Se debería guardar el nivel de visibilidad de la plantilla? Público/solo admin/solo profes/alumnos
	*/
	
	public function index(){
		// Eloquent
		$plantillas = Plantilla::all();
		return response()->json( $plantillas, 200 );
	}

	public function validar_plantilla($request){
		$reglas = [
			'archivo' => 'required|file|mimetypes:application/json,text/plain',
			'nombre' => 'required'
		];
		$this->validate($request, $reglas);
	}

	public function store(Request $request){
		if (!$request->hasFile('archivo'))
			return $this->error_response('No haz enviado el archivo', 401);

		$this->validar_plantilla($request);

		$nuevo_nombre = uniqid('plantilla_') . '.json';
		$uploaded = $request
			->file('archivo')
			->move('../storage/app/plantillas', $nuevo_nombre);

		if (!$uploaded)
			return $this->error_response('El archivo no se ha almacenado correctamente', 401);

		// nombre original: $request->file('archivo')->getClientOriginalName();
		$nombrePlantilla = $request->get('nombre');

		$plantilla = Plantilla::create([
			'archivo' => $nuevo_nombre,
			'nombre' => $nombrePlantilla
		]);

		if(!$plantilla){
			// borrar el archivo creado arriba...
			return $this->error_response('No se pudo crear la plantilla', 401);
		}

		// si se crea, lo devuelvo para que el front pueda hacer cosas con ello
		return $this->_response( $plantilla, 201);
	}
	
}
