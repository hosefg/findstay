<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Wisatawan extends Authenticatable
{

    use Notifiable;

    protected $table = 'wisatawans';

    protected $primaryKey = 'id_wisatawan';
    protected $fillable = ['id_wisatawan','nama_depan_wisatawan','nama_belakang_wisatawan','password_wisatawan','pesanan_id'];

    public function getAuthPassword()
    {
      return $this->password_wisatawan;
    }
}
