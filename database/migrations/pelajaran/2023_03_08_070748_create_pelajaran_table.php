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
        Schema::create('pelajaran', function (Blueprint $table) {
            $table->id('idPelajaran');
            $table->integer('kodePelajaran')->type('integer')->length(8);
            $table->string('nmPelajaran', 100);
            $table->string('nmSingkatan', 50);
            $table->tinyInteger('KKM')->type('tinyinteger')->length(4);
            $table->text('pengetahuanA');
            $table->text('pengetahuanB');
            $table->text('pengetahuanC');
            $table->text('pengetahuanD');
            $table->text('keterampilanA');
            $table->text('keterampilanB');
            $table->text('keterampilanC');
            $table->text('keterampilanD');
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
        Schema::dropIfExists('pelajaran');
    }
};
