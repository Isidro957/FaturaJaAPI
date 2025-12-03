<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class EmpresaScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // 1. Recupera empresa atual (definida no middleware TenantResolver)
        $empresa = app('empresaAtual');

        // 2. Se não há empresa atual → não aplica escopo (evita crash)
        if (!$empresa) {
            return;
        }

        // 3. Super Admin vê tudo — ignora escopo
        $user = auth()->user();
        if ($user && method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()) {
            return;
        }

        // 4. Aplicar o escopo de empresa em todas as queries
        $builder->where($model->getTable() . '.empresa_id', $empresa->id);
    }
}
