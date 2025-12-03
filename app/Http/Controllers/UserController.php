<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // ============================================================
    // LISTAR USUÁRIOS
    // ============================================================
    public function index(Request $request)
    {
        $role = session('auth0_roles')[0] ?? null;
        $tenantId = session('tenant_id');

        $query = User::with('roles', 'tenant');

        if ($role !== 'Admin') {
            $query->where('tenant_id', $tenantId);
        }

        return response()->json($query->get());
    }

    // ============================================================
    // VER DETALHES DE UM USUÁRIO
    // ============================================================
    public function show($id, Request $request)
    {
        $role = session('auth0_roles')[0] ?? null;
        $tenantId = session('tenant_id');

        $user = User::with('roles', 'tenant')->find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        if ($role !== 'Admin' && $user->tenant_id !== $tenantId) {
            return response()->json(['error' => 'Acesso negado'], 403);
        }

        return response()->json($user);
    }

    // ============================================================
    // CRIAR USUÁRIO
    // ============================================================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'role'      => 'required|string',
            'roles'     => 'array',     // roles múltiplas
            'avatar'    => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $tenantId = session('tenant_id');  

        $user = User::create([
            'nome'       => $request->nome,
            'email'      => $request->email,
            'role'       => $request->role,
            'tenant_id'  => $tenantId,
            'auth0_id'   => $request->auth0_id ?? null,
            'avatar'     => $request->avatar ?? null,
        ]);

        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        }

        return response()->json($user, 201);
    }

    // ============================================================
    // ATUALIZAR USUÁRIO
    // ============================================================
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        $role = session('auth0_roles')[0] ?? null;
        $tenantId = session('tenant_id');

        if ($role !== 'Admin' && $user->tenant_id !== $tenantId) {
            return response()->json(['error' => 'Acesso negado'], 403);
        }

        $validator = Validator::make($request->all(), [
            'nome'      => 'nullable|string|max:255',
            'email'     => 'nullable|email|unique:users,email,' . $user->id,
            'role'      => 'nullable|string',
            'roles'     => 'array',
            'avatar'    => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user->update($validator->validated());

        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        }

        return response()->json($user);
    }

    // ============================================================
    // EXCLUIR USUÁRIO
    // ============================================================
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        $role = session('auth0_roles')[0] ?? null;
        $tenantId = session('tenant_id');

        if ($role !== 'Admin' && $user->tenant_id !== $tenantId) {
            return response()->json(['error' => 'Acesso negado'], 403);
        }

        $user->delete();

        return response()->json(['message' => 'Usuário apagado com sucesso']);
    }
}
