<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\BelongsToEmpresa;

class ItemFatura extends Model
{
    use HasFactory;
    use BelongsToEmpresa; 

    protected $fillable = [
        'fatura_id',
        'produto_id',
        'quantidade',
        'preco_unitario',
        'descricao',
        'valor_desconto_unitario',
    ];

    /**
     * Um item pertence a uma fatura
     */
    public function fatura()
    {
        return $this->belongsTo(Fatura::class);
    }

    /**
     * Um item pertence a um produto
     */
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
