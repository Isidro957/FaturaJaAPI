<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relatorio extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'user_id',
        'tipo',
        'titulo',
        'descricao',
        'valor_total',
        'status',
    ];

    /**
     * Relação com a Empresa (tenant)
     */
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    /**
     * Usuário que criou o relatório
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relatórios podem estar ligados a várias faturas
     */
    public function faturas()
    {
        return $this->belongsToMany(Fatura::class, 'fatura_relatorio');
    }
}
