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
        Schema::table('nilai_d', function (Blueprint $table) {
            $table->foreign('idNilai', 'fk_nilai_d_nilai')
                ->references('idNilai')
                ->on('nilai')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });

        Schema::table('nilai_d', function (Blueprint $table) {
            $table->foreign('NIS', 'fk_nilai_d_siswa')
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
        Schema::table('nilai', function (Blueprint $table) {
            $table->dropForeign('fk_nilai_d_nilai');
        });
    }
};
