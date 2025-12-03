<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth0.jwt');
    }

    /**
     * Extrair dados do usuário do token + normalização
     */
    private function mapUser(Request $request)
    {
        $decoded = $request->get('user_auth0');
        $empresaId = $request->get('empresa_id');

        // Normalizar role
        $tipo = $decoded['https://meusistema.com/role'] ?? 'Cliente';
        $tipo = ucfirst(strtolower($tipo)); // empresa → Empresa

        return (object)[
            'email'      => $decoded['email'] ?? null,
            'tipo'       => $tipo,
            'empresa_id' => $empresaId
        ];
    }

    /**
     * LISTAR produtos
     */
    public function index(Request $request)
    {
        $usuario = $this->mapUser($request);

        $query = Produto::with('empresa');

        if ($usuario->tipo === 'Empresa') {
            $query->where('empresa_id', $usuario->empresa_id);
        }

        if ($usuario->tipo === 'Admin') {
            return response()->json($query->latest()->get());
        }

        return response()->json(['message' => 'Acesso não autorizado.'], 403);
    }

    /**
     * CRIAR produto (somente Empresa)
     */
    public function store(Request $request)
    {
        $usuario = $this->mapUser($request);

        if ($usuario->tipo !== 'Empresa') {
            return response()->json(['message' => 'Apenas empresas podem criar produtos.'], 403);
        }

        $validated = $request->validate([
            'nome'           => 'required|string|max:255',
            'descricao'      => 'nullable|string',
            'preco_unitario' => 'required|numeric|min:0',
            'estoque'        => 'nullable|integer|min:0',
        ]);

        $produto = Produto::create([
            ...$validated,
            'empresa_id' => $usuario->empresa_id
        ]);

        return response()->json($produto, 201);
    }

    /**
     * MOSTRAR produto
     */
    public function show(Request $request, Produto $produto)
    {
        $usuario = $this->mapUser($request);

        if ($usuario->tipo === 'Admin') {
            return response()->json($produto->load('empresa'));
        }

        if ($usuario->tipo === 'Empresa' && $produto->empresa_id == $usuario->empresa_id) {
            return response()->json($produto->load('empresa'));
        }

        return response()->json(['message' => 'Não autorizado.'], 403);
    }

    /**
     * ATUALIZAR produto
     */
    public function update(Request $request, Produto $produto)
    {
        $usuario = $this->mapUser($request);

        if ($usuario->tipo !== 'Admin' &&
            !($usuario->tipo === 'Empresa' && $produto->empresa_id == $usuario->empresa_id)) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        $validated = $request->validate([
            'nome'           => 'sometimes|string|max:255',
            'descricao'      => 'nullable|string',
            'preco_unitario' => 'sometimes|numeric|min:0',
            'estoque'        => 'nullable|integer|min:0',
        ]);

        $produto->update($validated);

        return response()->json($produto);
    }

    /**
     * REMOVER produto
     */
    public function destroy(Request $request, Produto $produto)
    {
        $usuario = $this->mapUser($request);

        if ($usuario->tipo !== 'Admin' &&
            !($usuario->tipo === 'Empresa' && $produto->empresa_id == $usuario->empresa_id)) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        $produto->delete();

        return response()->json(['message' => 'Produto eliminado com sucesso!']);
    }
}
