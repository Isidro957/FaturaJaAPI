<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
  protected $table = 'role_users';
  protected $fillable =[
        'nome',
        'email',
        'empresa_id',
        'auth0_id',
        'role',
  ];
  protected $guarded =[];
}


