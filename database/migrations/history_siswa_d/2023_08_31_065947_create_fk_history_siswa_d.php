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
        Schema::table('history_siswa_d', function (Blueprint $table) {
            $table->foreign('idHistory', 'fk_history_siswa_d_history_siswa')
                ->references('idHistory')
                ->on('history_siswa')
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
        Schema::dropIfExists('fk_history_siswa_d_history_siswa');
    }
};
