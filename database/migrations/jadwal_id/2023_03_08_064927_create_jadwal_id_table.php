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
        Schema::create('jadwal_id', function (Blueprint $table) {
            $table->id('jadwal_id');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('id_pelajaran');
            $table->index('id_pelajaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jadwal_id', function (Blueprint $table) {
            Schema::dropIfExists('jadwal_id');
        });
    }
};
