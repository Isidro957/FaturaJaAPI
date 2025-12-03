<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory; 

    protected $fillable = [
        'empresa_id',
        'nome',
        'descricao',
        'preco_unitario',
        'estoque',
    ];

    /**
     * Relação com a empresa.
     */
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
