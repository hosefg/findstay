<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->bigIncrements('id_pesanan');
            $table->timestamp('tanggal_pesanan');
            $table->bigInteger('total_harga');
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar');
            $table->string('pembayaran');
            $table->boolean('status_pembayaran');
            $table->unsignedBigInteger('wisatawan_id')->nullable();
            $table->timestamps();


        });

       Schema::table('pesanans', function($table) {
            $table->foreign('wisatawan_id')->references('id_wisatawan')->on('wisatawans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
}
