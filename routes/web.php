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

$router->get('/login', [ 'uses' => 'UsuariosController@getToken' ]);


/*
$router->group(['middleware' => ['auth'] ], function () use ($router){
	$router->get('/usuarios', "UsersController@index");
	$router->post('/usuarios', "UsersController@store");	
});


$router->get('/', function () use ($router) {
    return $router->app->version();
});

// usado para generar la API key
$router->get('/key', function () {
	return str_random(32);
});


*/