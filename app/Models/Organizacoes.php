<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organizacoes extends Model
{
  protected $table = 'organizacoes';
  protected $primaryKey='id';
  protected $fillable =[
    'name_org',
    'nif_org',
    'logo_org',
    'telefone_org',
    'email_org',
    'provincia_org',
    'tipo_org',
    'descricao_org'
  ];
  protected $guarded =[];
}
