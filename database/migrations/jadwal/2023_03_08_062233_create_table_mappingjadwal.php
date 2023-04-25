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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id('idJadwal');
            $table->bigInteger('idKelas', unsigned: true);
            $table->bigInteger('idThnAjaran', unsigned: true);
            $table->char('NIP', 10);
            $table->enum('hari', [
                'senin',
                'selasa',
                'rabu',
                'kamis',
                'jumat',
                'sabtu',
            ]);
            $table->bigInteger('idPelajaran', unsigned: true);
            $table->time('mulai');
            $table->time('selesai');
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
        Schema::table('jadwal', function (Blueprint $table) {
            Schema::dropIfExists('jadwal');
        });
    }
};
