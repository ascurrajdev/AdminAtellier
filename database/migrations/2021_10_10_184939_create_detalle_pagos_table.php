<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pagos', function (Blueprint $table) {
            $table->id();
            $table->integer("monto");
            $table->integer("nro_transferencia")->nullable(true)->default(0);
            $table->foreignId("factura_id");
            $table->foreignId("forma_pago_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_pagos');
    }
}
