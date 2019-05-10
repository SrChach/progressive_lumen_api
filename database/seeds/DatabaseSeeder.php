<?php

use Illuminate\Database\Seeder;

use App\Rol;
use App\Usuario;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncamos los datos de los modelos y insertamos de nuevo en cada seed
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		DB::table('rol_usuario')->truncate();
		Rol::truncate();
		Usuario::truncate();

		DB::statement('SET FOREIGN_KEY_CHECKS = 1');

		factory(Rol::class)->create( ['nombre' => 'administrador'] );
		factory(Rol::class)->create( ['nombre' => 'profesor' ]);
		factory(Rol::class)->create( ['nombre' => 'alumno' ]);

		factory(Usuario::class, 15)
			->create()
			->each(function($usuario){
				$usuario
					->roles()
					->attach( array_rand(array_flip(range(1, 3)), 2) );
			});
/*
		factory(Rol::class, 15)
			->create()
			->each(function($rol){
				// Para cada rol credo, asigna "n" permisos (n es el segundo param de array_rand)
				$rol
					->permisos()
					->attach( array_rand(range(1, 15), 2) );
			});
*/

    }
}
