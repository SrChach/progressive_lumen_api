<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DocumentoMigration extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documentos', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('titulo')->nullable();
			$table->string('descripcion')->nullable();
			$table->bigInteger('plantilla_id')->unsigned();
			$table->foreign('plantilla_id')->references('id')->on('plantillas');
			$table->bigInteger('usuario_id')->unsigned();
			$table->foreign('usuario_id')->references('id')->on('usuarios');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('documentos');
	}
}
