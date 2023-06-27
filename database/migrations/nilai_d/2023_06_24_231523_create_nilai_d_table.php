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
        Schema::create('nilai_d', function (Blueprint $table) {
            $table->id('idNilai_D');
            $table->decimal('nilai', 4, 1);
            $table->bigInteger('idNilai')->unsigned();
            $table->char('NIS', 8);
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
        Schema::dropIfExists('nilai_d');
    }
};
