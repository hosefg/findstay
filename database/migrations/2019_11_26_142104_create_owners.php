<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->bigIncrements('id_owner');
            $table->string('email_owner')->unique();
            $table->string('password');
            $table->string('nama_depan_owner');
            $table->string('nama_belakang_owner');
            //$table->unsignedBigInteger('homestay_id')->nullable();
            $table->timestamps();


        });

        /*Schema::table('owners', function($table) {
            $table->foreign('homestay_id')->references('id_homestay')->on('homestays');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('owners');
    }
}
