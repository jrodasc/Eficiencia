<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Notas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref')->unique();
            $table->string('nombre');
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->integer('horamaquina');
            $table->boolean('revision')->default(false);
            $table->timestamps();
        });

        Schema::create('articulo_nota', function (Blueprint $table) {
            $table->integer('articulo_id')->unsigned();
            $table->integer('nota_id')->unsigned();

            $table->foreign('articulo_id')->references('id')->on('articulos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('nota_id')->references('id')->on('notas')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['articulo_id', 'nota_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notas');
    }
}
