<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapor_d', function (Blueprint $table) {
            $table->id('idRapor_d');
            $table->bigInteger('idRapor')->unsigned();
            $table->string('nmSikap', 255);
            $table->text('deskripsiSikap');
            $table->string('nmEkstrakurikuler', 255);
            $table->text('deskripsiEkstrakurikuler');
            $table->string('nmPrestasi', 255);
            $table->text('deskripsiPrestasi');
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
        Schema::dropIfExists('rapor_d');
    }
};
