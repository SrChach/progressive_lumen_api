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
			$table->string('contenido')->nullable();
			$table->bigInteger('campo_id')->unsigned();
			$table->foreign('campo_id')->references('id')->on('campos');
			$table->bigInteger('usuario_id')->unsigned();
			$table->foreign('usuario_id')->references('id')->on('usuarios'); // el que lo creó
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
