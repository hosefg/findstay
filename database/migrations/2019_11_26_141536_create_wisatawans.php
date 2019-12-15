<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWisatawans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wisatawans', function (Blueprint $table) {
            $table->bigIncrements('id_wisatawan');
            $table->string('email_wisatawan')->unique();
            $table->string('nama_depan_wisatawan');
            $table->string('nama_belakang_wisatawan');
            $table->string('password_wisatawan');
            //$table->unsignedBigInteger('pesanan_id')->nullable();
            $table->timestamps();

        });

        /*Schema::table('wisatawans', function($table) {
            $table->foreign('pesanan_id')->references('id_pesanan')->on('pesanans');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wisatawans');
    }
}
