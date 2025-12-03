<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Traits\BelongsToEmpresa;

class Cliente extends Model
{
    use HasFactory;
    use BelongsToEmpresa;

    protected $fillable = [
        'empresa_id',
        'nome',
        'email',
        'nif',
        'endereco',
    ];

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function faturas(): HasMany
    {
        return $this->hasMany(Fatura::class, 'cliente_id');
    }
}
