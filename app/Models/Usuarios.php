<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
  protected $table = 'role__users';
  protected $fillable =[
    'user_id_area',
    'name',
    'profile_photo_path',
    'email',
    'password',
  ];
  protected $guarded =[];
}
