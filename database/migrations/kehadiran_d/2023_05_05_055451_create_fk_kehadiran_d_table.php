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
        Schema::table('kehadiran_d', function (Blueprint $table) {
            $table->foreign('idKehadiran', 'fk_kehadiran_d_kehadiran')
                ->references('idKehadiran')
                ->on('kehadiran')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });

        Schema::table('kehadiran_d', function (Blueprint $table) {
            $table->foreign('NIS', 'fk_kehadiran_d_siswa')
                ->references('NIS')
                ->on('siswa')
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
        Schema::table('kehadiran_d', function (Blueprint $table) {
            $table->dropForeign('fk_mappingkelas_guru');
        });
    }
};
