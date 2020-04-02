<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('empleado_id')->unsigned();
            $table->string('cliente');
            $table->string('nit');
            $table->date('fecha_venta');
            $table->date('total');
            $table->date('total_final');
            $table->date('qr',255);
            $table->date('codigo_control');
            $table->timestamps();

            $table->foreign('empleado_id')->references('id')->on('empleados')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
