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
        Schema::table('semester', function (Blueprint $table) {
            $table->foreign('idThnAjaran', 'fk_semester_tahun_ajaran')
                ->references('idThnAjaran')
                ->on('tahun_ajaran')
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
        Schema::table('semester', function (Blueprint $table) {
            $table->dropForeign('fk_semester_tahun_ajaran');
        });
    }
};
