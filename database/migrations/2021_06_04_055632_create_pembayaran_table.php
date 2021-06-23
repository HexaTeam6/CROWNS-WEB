<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pesanan')->nullable();
            $table->float('biaya_jahit')->nullable();
            $table->float('biaya_material')->nullable();
            $table->float('biaya_kirim')->nullable();
            $table->float('biaya_jemput')->nullable();
            $table->string('status_pembayaran', 2)->nullable();
            $table->string('metode_pembayaran')->nullable();

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
        Schema::dropIfExists('pembayaran');
    }
}
