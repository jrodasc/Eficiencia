<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Archivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nota_id')->unsigned()->nullable();
            $table->foreign('nota_id')->references('id')->on('notas');
            $table->integer('articulo_id')->unsigned()->nullable();
            $table->foreign('articulo_id')->references('id')->on('articulos');
            $table->string('filename');
            $table->string('nombre');
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
        Schema::dropIfExists('archivos');
    }
}
