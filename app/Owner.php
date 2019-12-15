<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Owner extends Authenticatable
{
    use Notifiable;

    protected $guard = 'owner';
     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */

    protected $primaryKey = 'id_owner';
    protected $fillable = ['id_owner','email_owner','nama_depan_owner','nama_belakang_owner'];
}
