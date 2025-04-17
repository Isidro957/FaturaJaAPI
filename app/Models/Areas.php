<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
  protected $table = 'areas';
  protected $primaryKey='id';
  protected $fillable =[
    'org_id',
    'nome_area',
    'slogan_area',
    'slogan_area',
    'telefone_area',
    'email_area',
    'descricao_area',
  ];
  protected $guarded =[];
}
