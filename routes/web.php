<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return "RESTful API under build";
});

$router->post('/login', [ 'uses' => 'UsuariosController@getToken' ]);

// Las acciones que requieran permisos de Admin irán acá
$router->group(['middleware' => ['admin'] ], function () use ($router){
	$router->get('/admin', function(){
		return "pasado";
	});
});

// Las acciones que requieran permisos de profesor irán acá
$router->group(['middleware' => ['profesor'] ], function () use ($router){
	$router->get('/profesor', function(){
		return "pasado";
	});
});

// Las acciones que requieran permisos de alumno irán acá
$router->group(['middleware' => ['alumno'] ], function () use ($router){
	$router->get('/alumno', function(){
		return "pasado";
	});
});