<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemilikiKatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memiliki_katalog', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penjahit')->nullable();
            $table->unsignedBigInteger('id_baju')->nullable();
            
            $table->foreign('id_penjahit')->references('id')->on('penjahit');
            $table->foreign('id_baju')->references('id')->on('baju');
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
        Schema::dropIfExists('memiliki_katalog');
    }
}
