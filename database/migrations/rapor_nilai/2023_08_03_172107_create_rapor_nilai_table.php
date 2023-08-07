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
        Schema::create('rapor_nilai', function (Blueprint $table) {
            $table->id('idRapor_nilai');
            $table->bigInteger('idRapor')->unsigned();
            $table->bigInteger('idPelajaran')->unsigned();
            $table->decimal('nilaiPengetahuan', 4, 1);
            $table->string('predikatPengetahuan', 1);
            $table->text('deskripsiPengetahuan');
            $table->decimal('nilaiKeterampilan', 4, 1);
            $table->string('predikatKeterampilan', 1);
            $table->text('deskripsiKeterampilan');
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
        Schema::dropIfExists('rapor_nilai');
    }
};
