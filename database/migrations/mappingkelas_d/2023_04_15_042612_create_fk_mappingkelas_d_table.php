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
        Schema::table('mappingkelas_d', function (Blueprint $table) {
            $table->foreign('idMapping', 'fk_mappingkelas_d_mappingkelas')
                ->references('idMapping')
                ->on('mapping_kelas')
                ->cascadeOnUpdate()
                ->cascadeOnUpdate();
        });

        Schema::table('mappingkelas_d', function (Blueprint $table) {
            $table->foreign('NIS', 'fk_mappingkelas_d_siswa')
                ->references('NIS')
                ->on('siswa')
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
        Schema::table('mappingkelas_d', function (Blueprint $table) {
            $table->dropForeign('fk_mappingkelas_d_mappingkelas');
        });

        Schema::table('mappingkelas_d', function (Blueprint $table) {
            $table->dropForeign('fk_mappingkelas_d_siswa');
        });
    }
};
