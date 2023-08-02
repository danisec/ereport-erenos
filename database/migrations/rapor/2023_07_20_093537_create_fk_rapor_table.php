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
        Schema::table('rapor', function (Blueprint $table) {
            $table->foreign('NIS', 'fk_rapor_siswa')
                ->references('NIS')
                ->on('siswa')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });

        Schema::table('rapor', function (Blueprint $table) {
            $table->foreign('idKelas', 'fk_rapor_kelas')
                ->references('idKelas')
                ->on('kelas')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });

        Schema::table('rapor', function (Blueprint $table) {
            $table->foreign('idSemester', 'fk_rapor_semester')
                ->references('idSemester')
                ->on('semester')
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
        Schema::table('rapor', function (Blueprint $table) {
            $table->dropForeign('fk_rapor_siswa');
        });

        Schema::table('rapor', function (Blueprint $table) {
            $table->dropForeign('fk_rapor_kelas');
        });

        Schema::table('rapor', function (Blueprint $table) {
            $table->dropForeign('fk_rapor_semester');
        });
    }
};
