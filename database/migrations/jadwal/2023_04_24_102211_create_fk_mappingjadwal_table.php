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
       Schema::table('jadwal', function (Blueprint $table) {
            $table->foreign('idKelas', 'fk_jadwal_kelas')
                ->references('idKelas')
                ->on('kelas')
                ->restrictOnDelete()
                ->restrictOnUpdate();
        });

       Schema::table('jadwal', function (Blueprint $table) {
            $table->foreign('idThnAjaran', 'fk_jadwal_tahunajaran')
                ->references('idThnAjaran')
                ->on('tahun_ajaran')
                ->restrictOnDelete()
                ->restrictOnUpdate();
        });

       Schema::table('jadwal', function (Blueprint $table) {
            $table->foreign('NIP', 'fk_jadwal_guru')
                ->references('NIP')
                ->on('guru')
                ->restrictOnDelete()
                ->restrictOnUpdate();
        });

       Schema::table('jadwal', function (Blueprint $table) {
            $table->foreign('idPelajaran', 'fk_jadwal_pelajaran')
                ->references('idPelajaran')
                ->on('pelajaran')
                ->restrictOnDelete()
                ->restrictOnUpdate();
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
            $table->dropForeign('fk_jadwal_kelas');
        });
        
        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropForeign('fk_jadwal_tahunajaran');
        });

        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropForeign('fk_jadwal_guru');
        });

        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropForeign('fk_jadwal_pelajaran');
        });
    }
};
