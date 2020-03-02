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
            $table->string("nombres");
            $table->string("apellidos");
            $table->string("lugar_nacimiento");
            $table->date("fecha_nacimiento");
            $table->string("sexo");
            $table->string("identificacion")->unique();
            $table->string("direccion_residencia");
            $table->string("correo")->nullable();  //puede contener nulos, hay hermanos que no tienen correo
            $table->string("telefono");
            $table->string("estado_civil");
            $table->string("nom_conyugue")->nullable();
            $table->string("cant_hijos"); 
            $table->string("nombre_hijos")->nullable();
            $table->string("bautismo");
            $table->date("fecha_bautismo")->nullable();
            $table->string("pastor_bautismo")->nullable();
            $table->string("espiritu");
            $table->date("fecha_espiritu")->nullable();
            $table->string("cargos")->nullable();
            $table->string("estado");
            $table->bigInteger("profesion_id")->unsigned();
            $table->foreign("profesion_id")->references("id")->on("profesions");
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
