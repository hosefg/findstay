<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'id_admin';
    protected $fillable = ['id_admin','email_admin','password_admin'];
}
