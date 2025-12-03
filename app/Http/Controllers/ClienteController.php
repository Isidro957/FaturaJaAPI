<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empresa;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth0.jwt', 'role:Admin,Empresa']);
    }

    /**
     * Obter dados do usuário autenticado
     */
    private function mapUser(Request $request)
    {
        $token = $request->get('user_auth0');  // payload do JWT

        $roles = $token['roles'] ?? []; // Roles definidas no Auth0
        $email = $token['email'] ?? null;

        // Empresa logada no sistema
        $empresa = Empresa::where('email', $email)->first();

        return (object)[
            'email' => $email,
            'roles' => $roles,
            'isAdmin' => in_array('Admin', $roles),
            'isEmpresa' => in_array('Empresa', $roles),
            'isCliente' => in_array('Cliente', $roles),
            'empresa_id' => $empresa->id ?? null
        ];
    }

    /**
     * Listar clientes
     */
    public function index(Request $request)
    {
        $user = $this->mapUser($request);

        if ($user->isAdmin) {
            return Cliente::latest()->get();
        }

        if ($user->isEmpresa) {
            return Cliente::where('empresa_id', $user->empresa_id)->latest()->get();
        }

        return response()->json(['message' => 'Acesso negado'], 403);
    }

    /**
     * Criar cliente
     */
    public function store(Request $request)
    {
        $user = $this->mapUser($request);

        if (!$user->isEmpresa) {
            return response()->json(['message' => 'Apenas empresas podem criar clientes'], 403);
        }

        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string|max:20',
            'nif' => 'nullable|string|max:20|unique:clientes,nif,NULL,id,empresa_id,' . $user->empresa_id,
            'endereco' => 'nullable|string'
        ]);

        $cliente = Cliente::create([
            ...$validated,
            'empresa_id' => $user->empresa_id
        ]);

        return response()->json($cliente, 201);
    }

    /**
     * Mostrar cliente
     */
    public function show(Request $request, Cliente $cliente)
    {
        $user = $this->mapUser($request);

        if ($user->isAdmin || ($user->isEmpresa && $cliente->empresa_id === $user->empresa_id)) {
            return $cliente;
        }

        return response()->json(['message' => 'Acesso negado'], 403);
    }

    /**
     * Atualizar cliente
     */
    public function update(Request $request, Cliente $cliente)
    {
        $user = $this->mapUser($request);

        if (!$user->isAdmin && !($user->isEmpresa && $cliente->empresa_id === $user->empresa_id)) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        $validated = $request->validate([
            'nome' => 'sometimes|string|max:100',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string|max:20',
            'nif' => 'nullable|string|max:20|unique:clientes,nif,' . $cliente->id . ',id,empresa_id,' . $cliente->empresa_id,
            'endereco' => 'nullable|string'
        ]);

        $cliente->update($validated);

        return $cliente;
    }

    /**
     * Excluir cliente
     */
    public function destroy(Request $request, Cliente $cliente)
    {
        $user = $this->mapUser($request);

        if (!$user->isAdmin && !($user->isEmpresa && $cliente->empresa_id === $user->empresa_id)) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        $cliente->delete();

        return response()->json(['message' => 'Cliente removido com sucesso'], 200);
    }
}
