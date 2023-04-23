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
        Schema::table('mapping_kelas', function (Blueprint $table) {
            $table->foreign('idKelas', 'fk_mappingkelas_kelas')
                ->references('idKelas')
                ->on('kelas')
                ->restrictOnUpdate()
                ->restrictOnDelete();
        });

        Schema::table('mapping_kelas', function (Blueprint $table) {
            $table->foreign('idThnAjaran', 'fk_mappingkelas_tahunajaran')
                ->references('idThnAjaran')
                ->on('tahun_ajaran')
                ->restrictOnUpdate()
                ->restrictOnDelete();
        });

        Schema::table('mapping_kelas', function (Blueprint $table) {
            $table->foreign('NIP', 'fk_mappingkelas_guru')
                ->references('NIP')
                ->on('guru')
                ->restrictOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mapping_kelas', function (Blueprint $table) {
            $table->dropForeign('fk_mappingkelas_guru');
        });

        Schema::table('mapping_kelas', function (Blueprint $table) {
            $table->dropForeign('fk_mappingkelas_kelas');
        });

        Schema::table('mapping_kelas', function (Blueprint $table) {
            $table->dropForeign('fk_mappingkelas_tahunajaran');
        });
    }
};
