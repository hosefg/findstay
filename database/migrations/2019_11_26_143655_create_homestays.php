<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomestays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homestays', function (Blueprint $table) {
            $table->bigIncrements('id_homestay');
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->string('nama_homestay');
            $table->float('harga_homestay',10,2);
            $table->text('deskripsi_homestay');
            $table->string('foto_homestay')->nullable();
            $table->string('alamat_homestay');
            $table->float('latitude_homestay',8,5);
            $table->float('longitude_homestay',8,5);
            $table->timestamps();
        });

        Schema::table('homestays', function($table) {
            $table->foreign('owner_id')->references('id_owner')->on('owners');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homestays');
    }
}
