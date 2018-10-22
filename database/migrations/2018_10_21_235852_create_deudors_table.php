<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeudorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deudors', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            //Codigo agregado
            $table->string('nombre_apellido');
            $table->string('documento')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->double('saldo',15,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deudors');
    }
}
