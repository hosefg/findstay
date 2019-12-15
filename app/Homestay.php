<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homestay extends Model
{
    protected $primaryKey = 'id_homestay';
    protected $fillable = ['id_homestay','nama_homestay','harga_homestay','deskripsi_homestay','foto_homestay','alamat_homestay','latitude_homestay','longitude_homestay'];
}
