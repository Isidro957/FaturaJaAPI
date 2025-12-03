<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Areas extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_id',
        'name_area',
        'slogan_area',
        'telefone_area',
        'email_area',
        'descricao_area',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'emp_id');
    }
}
