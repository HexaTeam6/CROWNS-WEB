<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokasiPenjemputanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokasi_penjemputan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pesanan');
            $table->string('kode_pos')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('alamat')->nullable();
            $table->dateTime('waktu')->nullable();
            $table->string('instruksi')->nullable();
            
            $table->foreign('id_pesanan')->references('id')->on('pesanan');
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
        Schema::dropIfExists('lokasi_penjemputan');
    }
}
