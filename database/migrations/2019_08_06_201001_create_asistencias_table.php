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
            $table->bigInteger("detalleingreso_id")->unsigned();
            $table->foreign("detalleingreso_id")->references("id")->on("detalleingresos");
            $table->integer("canti_hermanos");
            $table->integer("canti_hermanas");
            $table->integer("canti_visitas");
            $table->integer("canti_niños");
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
