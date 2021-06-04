<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penjahit')->nullable();
            $table->unsignedBigInteger('id_konsumen')->nullable();
            $table->unsignedBigInteger('id_baju')->nullable();
            $table->unsignedBigInteger('id_design_kostum')->nullable();
            $table->integer('jumlah')->nullable();
            $table->float('biaya_total')->nullable();
            $table->string('status_pesanan')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            
            $table->foreign('id_penjahit')->references('id')->on('penjahit');
            $table->foreign('id_konsumen')->references('id')->on('konsumen');
            $table->foreign('id_baju')->references('id')->on('baju');
            $table->foreign('id_design_kostum')->references('id')->on('design_kostum');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
}
