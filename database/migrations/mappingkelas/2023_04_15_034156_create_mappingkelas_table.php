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
        Schema::create('mapping_kelas', function (Blueprint $table) {
            $table->id('idMapping');
            $table->bigInteger('idKelas');
            $table->bigInteger('idThnAjaran ');
            $table->string('NIP ', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mappingkelas');
    }
};
