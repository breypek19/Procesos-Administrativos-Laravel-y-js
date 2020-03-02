<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEgresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egresos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("rubroegreso_id")->unsigned();
            $table->foreign("rubroegreso_id")->references("id")->on("rubroegresos");
            $table->bigInteger("detallegreso_id")->unsigned();
            $table->foreign("detallegreso_id")->references("id")->on("detallegresos");
            $table->double("cantidad", 10, 2);
            $table->string("dia");
            $table->string("mes");
            $table->string("año");
            $table->string("descripcion");
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
        Schema::dropIfExists('egresos');
    }
}
