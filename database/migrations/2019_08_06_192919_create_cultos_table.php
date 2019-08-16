<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCultosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cultos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("detalleingreso_id")->unsigned();
            $table->foreign("detalleingreso_id")->references("id")->on("detalleingresos");
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
        Schema::dropIfExists('cultos');
    }
}
