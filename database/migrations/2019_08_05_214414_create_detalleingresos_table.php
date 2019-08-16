<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleingresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleingresos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("nombre");
            $table->bigInteger("rubroingreso_id")->unsigned();
            $table->foreign("rubroingreso_id")->references("id")->on("rubroingresos");
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
        Schema::dropIfExists('detalleingresos');
    }
}
