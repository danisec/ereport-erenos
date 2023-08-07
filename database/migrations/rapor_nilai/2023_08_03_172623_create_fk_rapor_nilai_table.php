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
        Schema::table('rapor_nilai', function (Blueprint $table) {
            $table->foreign('idRapor', 'fk_rapor_nilai_rapor')
                ->references('idRapor')
                ->on('rapor')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });

        Schema::table('rapor_nilai', function (Blueprint $table) {
            $table->foreign('idPelajaran', 'fk_rapor_nilai_pelajaran')
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
        Schema::table('rapor_d', function (Blueprint $table) {
            $table->dropForeign('fk_rapor_nilai_rapor');
        });

        Schema::table('rapor_d', function (Blueprint $table) {
            $table->dropForeign('fk_rapor_nilai_pelajaran');
        });
    }
};
