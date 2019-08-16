<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("nombre");
            $table->string("apellidos");
            $table->string("lugar_nacimiento");
            $table->date("fecha_nacimiento");
            $table->string("sexo");
            $table->string("identificacion");
            $table->string("direccion_residencia");
            $table->string("correo")->unique();
            $table->string("telefono");
            $table->string("profesion");
            $table->string("estado civil");
            $table->string("nom_conyugue");
            $table->string("cant_hijos");
            $table->string("bautismo");
            $table->date("fecha_bautismo");
            $table->string("pastor_bautismo");
            $table->string("espiritu");
            $table->date("fecha_espiritu");
            $table->string("cargos");
            $table->string("estado");
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
        Schema::dropIfExists('personas');
    }
}
