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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id('idNilai');
            $table->date('tanggal');
            $table->enum('aspek', ['Pengetahuan', 'Keterampilan']);
            $table->enum('jenis', ['Harian', 'Pertengahan Tengah Semester', 'Pertengahan Akhir Semester']);
            $table->bigInteger('idMateri')->unsigned();
            $table->bigInteger('idKelas')->unsigned();
            $table->char('NIP', 10);
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
        Schema::dropIfExists('nilai');
    }
};
