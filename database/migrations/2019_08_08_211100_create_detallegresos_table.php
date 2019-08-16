<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallegresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallegresos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("nombre");
            $table->bigInteger("rubroegreso_id")->unsigned();
            $table->foreign("rubroegreso_id")->references("id")->on("rubroegresos");
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
        Schema::dropIfExists('detallegresos');
    }
}
