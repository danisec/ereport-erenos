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
        Schema::table('nilai', function (Blueprint $table) {
            $table->foreign('NIP', 'fk_nilai_guru')
                ->references('NIP')
                ->on('guru')
                ->cascadeOnUpdate()
                ->cascadeOnUpdate();
        });

        Schema::table('nilai', function (Blueprint $table) {
            $table->foreign('idKelas', 'fk_nilai_kelas')
                ->references('idKelas')
                ->on('kelas')
                ->cascadeOnUpdate()
                ->cascadeOnUpdate();
        });

        Schema::table('nilai', function (Blueprint $table) {
            $table->foreign('idMateri', 'fk_nilai_materi')
                ->references('idMateri')
                ->on('materi')
                ->cascadeOnUpdate()
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
        Schema::table('nilai', function (Blueprint $table) {
            $table->dropForeign('fk_nilai_guru');
        });

        Schema::table('nilai', function (Blueprint $table) {
            $table->dropForeign('fk_nilai_kelas');
        });

        Schema::table('nilai', function (Blueprint $table) {
            $table->dropForeign('fk_nilai_materi');
        });
    }
};
