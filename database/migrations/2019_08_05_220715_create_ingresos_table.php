<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("rubroingreso_id")->unsigned();
            $table->foreign("rubroingreso_id")->references("id")->on("rubroingresos");
            $table->double("cantidad", 10, 2);
            $table->string("dia");
            $table->string("mes");
            $table->string("año");
            $table->string("descripcion");
            $table->timestamps();
        });
    }
  //  $table->decimal('amount', 8, 2);

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingresos');
    }
}
