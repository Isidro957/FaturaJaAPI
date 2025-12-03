<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory; 
    
    protected $table = 'pagamentos'; 

    protected $fillable = [
        'empresa_id',       
        'fatura_id',
        'valor_pago',
        'metodo_pagamento', 
        'data_pagamento',
        'valor_troco',
        'valor_desconto', 
    ];

    /**
     * O pagamento pertence a uma única fatura.
     */
    public function fatura()
    {
        return $this->belongsTo(Fatura::class);
    }
}
