<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Traits\BelongsToEmpresa;

class Fatura extends Model
{
    use HasFactory;
    use BelongsToEmpresa;

protected $fillable = [
    'empresa_id',
    'cliente_id', 
    'user_id',    
    'numero',
    'data_emissao',
    'data_vencimento',
    'valor_subtotal',
    'valor_impostos',
    'valor_descontos',
    'valor_total',
    'status',
    'tipo',
    'nif_cliente', 
    'arquivo_pdf', // <-- adiciona este campo
];
protected $hidden = [
    'empresa_id',
];
    
    protected $casts = [
        'data_emissao' => 'date',
        'data_vencimento' => 'date',
    ];

    // --- RELACIONAMENTOS ---

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
    
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function itens(): HasMany
    {
        return $this->hasMany(ItemFatura::class);
    }
    
    public function pagamentos(): HasMany
    {
        return $this->hasMany(Pagamento::class);
    }
}
