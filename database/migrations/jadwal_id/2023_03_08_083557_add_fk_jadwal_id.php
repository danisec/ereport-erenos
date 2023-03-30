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
        Schema::table('jadwal_id', function (Blueprint $table) {
            $table->foreignId('id_jadwal', 'fk_jadwalid_jadwal')
                ->references('id_jadwal')
                ->on('jadwal')
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
        Schema::table('jadwal_id', function (Blueprint $table) {
            $table->dropForeign('fk_jadwalid_jadwal');
        });
    }
};
