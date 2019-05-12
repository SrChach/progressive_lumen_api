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
    return $router->app->version();
});

$router->post('/login', [ 'uses' => 'UsuariosController@getToken' ]);

$router->post('/query', 'UsuariosController@rol');

$router->group(['middleware' => ['auth'] ], function () use ($router){
	$router->get('/usr', function(){
		return "pasado";
	});
});

// Las acciones que requieran permisos de Admin irán acá
$router->group(['middleware' => ['admin'] ], function () use ($router){
	$router->get('/admin', function(){
		return "pasado";
	});
});


/*
	// usado para generar la API key
	$router->get('/key', function () {
		return str_random(32);
	});
*/