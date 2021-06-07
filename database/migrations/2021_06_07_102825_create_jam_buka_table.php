<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJamBukaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jam_buka', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penjahit');
            $table->string('hari');
            $table->time('jam_buka');
            $table->time('jam_tutup');

            $table->foreign('id_penjahit')->references('id')->on('penjahit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jam_buka');
    }
}
