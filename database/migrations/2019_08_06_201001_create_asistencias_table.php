<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("canti_hermanos");
            $table->integer("canti_hermanas");
            $table->integer("canti_visitas");
            $table->integer("canti_niños");
            $table->string("dia");
            $table->string("mes");
            $table->string("año");
            $table->string("dia_semana");
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
        Schema::dropIfExists('asistencias');
    }
}
