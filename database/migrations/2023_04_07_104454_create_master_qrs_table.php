<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterQrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_qrs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_id');
            $table->timestamps();

            $table->foreign('jadwal_id')->references('id')->on('jadwals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_qrs');
    }
}
