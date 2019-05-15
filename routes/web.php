<?php

// Falta un middleware que solo cheque si ya estás dentro o no, sin importar que roles tengas (cualquiera registrado puede tener una firma)

// faltan las funciones para responder automático errores y success, sin necesidad de tanto codigo

$router->get('/', function () use ($router) {
	return "RESTful API under build";
});

$router->get('/plantillas', 'PlantillaController@index');
$router->post('/plantillas', 'PlantillaController@store');

$router->post('/login', 'UsuarioController@getToken');

// Las acciones que requieran permisos de Admin irán acá
$router->group(['middleware' => ['admin'] ], function () use ($router){
	$router->get('/admin', function(){ return "pasado"; });
});

// Las acciones que requieran permisos de profesor irán acá
$router->group(['middleware' => ['profesor'] ], function () use ($router){
	$router->get('/profesor', function(){ return "pasado"; });
});

// Las acciones que requieran permisos de alumno irán acá
$router->group(['middleware' => ['alumno'] ], function () use ($router){
	$router->get('/alumno', function(){ return "pasado"; });
});


// De aqui a mas abajo: Ejemplo de manejo de json, se usará para los documentos
function reemplazar_uno_con_varios($buscar, $arreglo_nuevas, $cadena){
	$size_search = strlen($buscar);
	foreach ($arreglo_nuevas as $reemplazar) {
		if (strpos($cadena, $buscar) !== false){
			$inicio_cadena = strpos($cadena, $buscar);
			$cadena = substr_replace($cadena, $reemplazar, $inicio_cadena, $size_search);
		}
	}
	return $cadena;
}

$router->get('/file', function(){
	$json = file_get_contents("../storage/app/template.json");
	$replacers = ['palabra_cambiada_1', 'palabra_cambiada_2', 'palabra_cambiada_3'];
	$json = reemplazar_uno_con_varios('codified_content', $replacers, $json);
	return response($json)->header('Content-Type', 'application/json');
});

$router->get('/plantilla', function(){
	$json = file_get_contents("../storage/app/plantilla.json");
	return response($json)->header('Content-Type', 'application/json');
});