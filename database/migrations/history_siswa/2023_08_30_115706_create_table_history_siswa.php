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
        Schema::create('history_siswa', function (Blueprint $table) {
            $table->id('idHistory');
            $table->bigInteger('idSemester')->unsigned();
            $table->bigInteger('idKelas')->unsigned();
            $table->char('NIS', 8);
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
        Schema::dropIfExists('history_siswa');
    }
};
