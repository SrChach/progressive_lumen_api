<?php

use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

// Las clases que se metan acá deben estar importadas en DatabaseSeeder
$factory->define(App\Rol::class, function (Faker\Generator $faker) {
	return [
		'nombre' => $faker->randomElement($array = ['Administrador', 'Profesor', 'Alumno'])
	];
});

$factory->define(App\Usuario::class, function (Faker\Generator $faker) {
	return [
		'nombre' => $faker->firstName,
		'appaterno' => $faker->lastName,
		'apmaterno' => $faker->lastName,
		'email' => $faker->email,
		'username' => $faker->username,
		'password' => Hash::make('pass'),
		'api_token' => str_random(60)
	];
});
