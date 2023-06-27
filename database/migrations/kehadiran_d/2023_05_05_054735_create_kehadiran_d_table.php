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
        Schema::create('kehadiran_d', function (Blueprint $table) {
            $table->id('idKehadiran_D');
            $table->bigInteger('idKehadiran')->unsigned();
            $table->char('NIS', 8);
            $table->enum('status', ['Hadir', 'Sakit', 'Izin', 'Alpha']);
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
        Schema::dropIfExists('kehadiran_d');
    }
};
