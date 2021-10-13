<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimbradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timbrados', function (Blueprint $table) {
            $table->id();
            $table->integer("nro_timbrado")->unique();
            $table->date("inicio_vigencia");
            $table->date("fin_vigencia");
            $table->integer("desde_nro_habilitado");
            $table->integer("hasta_nro_habilitado");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timbrados');
    }
}
