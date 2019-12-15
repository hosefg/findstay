<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $primaryKey = 'id_pesanan';
    protected $fillable = ['id_pesanan','tanggal_pesanan','tanggal_masuk','tanggal_keluar','pembayaran','status_pembayaran','total_harga','nama_homestay'];
}
