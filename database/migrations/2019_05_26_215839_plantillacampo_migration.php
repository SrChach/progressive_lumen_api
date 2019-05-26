<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlantillacampoMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantillacampos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('palabraClave');
            $table->integer('vecesRepite');
            $table->boolean('isImage');
            $table->bigInteger('plantilla_id')->unsigned();
            $table->foreign('plantilla_id')->references('id')->on('plantillas');
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
        Schema::dropIfExists('plantillacampos');
    }
}
