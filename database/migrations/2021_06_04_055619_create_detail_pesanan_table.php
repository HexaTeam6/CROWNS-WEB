<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pesanan')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->float('lengan')->nullable();
            $table->float('pinggang')->nullable();
            $table->float('dada')->nullable();
            $table->float('leher')->nullable();
            $table->float('tinggi_tubuh')->nullable();
            $table->float('berat_badan')->nullable();
            $table->text('instruksi_pembuatan')->nullable();
            
            $table->foreign('id_pesanan')->references('id')->on('pesanan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pesanan');
    }
}
