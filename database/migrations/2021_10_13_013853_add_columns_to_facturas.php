<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToFacturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facturas', function (Blueprint $table) {
            $table->integer("nro_factura");
            $table->string("razon_social");
            $table->string("ruc");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facturas', function (Blueprint $table) {
            $table->dropColumn("nro_factura");
            $table->dropColumn("razon_social");
            $table->dropColumn("ruc");
        });
    }
}
