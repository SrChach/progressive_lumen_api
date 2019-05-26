<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DocumentocampoMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentocampos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('contenido')->nullable();
            $table->bigInteger('plantillacampos_id')->unsigned();
            $table->foreign('plantillacampos_id')->references('id')->on('plantillacampos');
            $table->bigInteger('documento_id')->unsigned();
            $table->foreign('documento_id')->references('id')->on('documentos'); // el que lo creó
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
        Schema::dropIfExists('documentocampos');
    }
}
