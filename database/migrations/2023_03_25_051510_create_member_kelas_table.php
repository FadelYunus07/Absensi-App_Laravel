<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_kelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('master_id');
            $table->string('kd_kelas');
            $table->string('nim_murid');
            $table->string('thn_ajaran');
            $table->timestamps();

            $table->foreign('master_id')->references('id')->on('master_kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_kelas');
    }
}
