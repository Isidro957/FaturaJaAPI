<?php

namespace App\Models\Traits;

use App\Models\Scopes\EmpresaScope;
use Illuminate\Database\Eloquent\Builder;

trait BelongsToEmpresa
{
    /**
     * Boot do trait: aplica escopo global e força empresa_id automaticamente.
     */
    protected static function bootBelongsToEmpresa()
    {
        parent::boot();

        /**
         * 1) Aplicar escopo global (todas as queries serão filtradas por empresa)
         */
        static::addGlobalScope(new EmpresaScope);

        /**
         * 2) Antes de criar, definir empresa_id automaticamente
         */
        static::creating(function ($model) {
            $empresaAtual = app('empresaAtual'); // empresa vinda via middleware
            $user = auth();

            // Se já veio com empresa_id (caso super admin queira definir), não mexe
            if (!empty($model->empresa_id)) {
                return;
            }

            // Se o usuário for super admin, não força empresa
            if ($user && method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()) {
                return;
            }

            // Empresa atual existe → atribui
            if ($empresaAtual) {
                $model->empresa_id = $empresaAtual->id;
            } else {
                // Evita salvar registros sem empresa_id acidentalmente
                throw new \Exception("Nenhuma empresa ativa encontrada para atribuir empresa_id.");
            }
        });

        /**
         * 3) Suporte para updates/saves (caso empresa_id esteja vazio)
         */
        static::saving(function ($model) {
            $empresaAtual = app('empresaAtual');

            if (empty($model->empresa_id) && $empresaAtual) {
                $model->empresa_id = $empresaAtual->id;
            }
        });
    }

    /**
     * 4) Relacionamento com empresa
     */
    public function empresa()
    {
        return $this->belongsTo(\App\Models\Empresa::class);
    }

    /**
     * 5) Query sem escopo global (para relatórios/admin)
     */
    public static function forAllEmpresas(): Builder
    {
        return (new static)->newQueryWithoutScope(EmpresaScope::class);
    }

    /**
     * 6) Query manual filtrada por empresa específica
     */
    public function scopeWhereEmpresa(Builder $query, $empresaId)
    {
        return $query
            ->withoutGlobalScope(EmpresaScope::class)
            ->where('empresa_id', $empresaId);
    }
}
