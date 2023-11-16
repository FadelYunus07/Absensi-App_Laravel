<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_guru');
            $table->string('kd_guru');
            $table->string('name');
            $table->timestamp('waktu_absen_masuk')->nullable();
            $table->timestamp('waktu_absen_pulang')->nullable();
            $table->string('status')->default('tidak hadir');
            $table->timestamps();

            $table->foreign('id_guru')->references('id')->on('gurus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presensis');
    }
}
