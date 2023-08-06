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
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });

       Schema::table('jadwal', function (Blueprint $table) {
            $table->foreign('idSemester', 'fk_jadwal_semester')
                ->references('idSemester')
                ->on('semester')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });

       Schema::table('jadwal', function (Blueprint $table) {
            $table->foreign('NIP', 'fk_jadwal_guru')
                ->references('NIP')
                ->on('guru')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });

       Schema::table('jadwal', function (Blueprint $table) {
            $table->foreign('idPelajaran', 'fk_jadwal_pelajaran')
                ->references('idPelajaran')
                ->on('pelajaran')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
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
            $table->dropForeign('fk_jadwal_semester');
        });

        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropForeign('fk_jadwal_guru');
        });

        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropForeign('fk_jadwal_pelajaran');
        });
    }
};
