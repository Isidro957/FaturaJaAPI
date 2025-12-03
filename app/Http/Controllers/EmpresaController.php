<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    public function __construct()
    {
        // Usa middleware Auth0 JWT
        $this->middleware('auth0.jwt');
    }

    /**
     * Mapear usuário do token Auth0
     */
    private function mapUser(Request $request)
    {
        $decoded = $request->get('user_auth0'); // dados do token

        return (object)[
            'email' => $decoded['email'] ?? null,
            'tipo' => $decoded['https://meusistema.com/role'] ?? 'cliente', // role personalizada
        ];
    }

    /**
     * Listar empresas (somente Admin)
     */
    public function index(Request $request)
    {
        $usuario = $this->mapUser($request);

        if ($usuario->tipo !== 'Admin') {
            return response()->json(['message' => 'Apenas administradores podem listar empresas.'], 403);
        }

        return response()->json(Empresa::latest()->get());
    }

    /**
     * Criar empresa (somente Admin)
     */
    public function store(Request $request)
    {
        $usuario = $this->mapUser($request);

        if ($usuario->tipo !== 'Admin') {
            return response()->json(['message' => 'Apenas administradores podem criar empresas.'], 403);
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'slug' => 'required|string|unique:empresas',
            'nif' => 'required|string|unique:empresas',
            'email' => 'nullable|email|unique:empresas',
            'endereco' => 'nullable|string',
            'telefone' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $dados = $request->all();

        if ($request->hasFile('logo')) {
            $dados['logo'] = $request->file('logo')->store('empresas', 'public');
        }

        $empresa = Empresa::create($dados);

        return response()->json([
            'message' => 'Empresa criada com sucesso!',
            'empresa' => $empresa
        ], 201);
    }

    /**
     * Mostrar empresa (Admin pode todas, empresa só a sua)
     */
    public function show(Request $request, Empresa $empresa)
    {
        $usuario = $this->mapUser($request);

        if ($usuario->tipo === 'Admin') {
            return response()->json($empresa);
        }

        // Empresa só vê ela mesma
        if ($usuario->tipo === 'empresa' && $usuario->email === $empresa->email) {
            return response()->json($empresa);
        }

        return response()->json(['message' => 'Não autorizado.'], 403);
    }

    /**
     * Atualizar empresa (Admin ou a própria empresa)
     */
    public function update(Request $request, Empresa $empresa)
    {
        $usuario = $this->mapUser($request);

        if ($usuario->tipo !== 'Admin' && $usuario->email !== $empresa->email) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        $request->validate([
            'nome' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|unique:empresas,slug,' . $empresa->id,
            'nif' => 'sometimes|string|unique:empresas,nif,' . $empresa->id,
            'email' => 'sometimes|email|unique:empresas,email,' . $empresa->id,
            'endereco' => 'nullable|string',
            'telefone' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $dados = $request->all();

        if ($request->hasFile('logo')) {
            if ($empresa->logo && Storage::disk('public')->exists($empresa->logo)) {
                Storage::disk('public')->delete($empresa->logo);
            }

            $dados['logo'] = $request->file('logo')->store('empresas', 'public');
        }

        $empresa->update($dados);

        return response()->json([
            'message' => 'Empresa atualizada com sucesso!',
            'empresa' => $empresa
        ]);
    }

    /**
     * Excluir empresa (somente Admin)
     */
    public function destroy(Request $request, Empresa $empresa)
    {
        $usuario = $this->mapUser($request);

        if ($usuario->tipo !== 'Admin') {
            return response()->json(['message' => 'Apenas administradores podem excluir empresas.'], 403);
        }

        if ($empresa->logo && Storage::disk('public')->exists($empresa->logo)) {
            Storage::disk('public')->delete($empresa->logo);
        }

        $empresa->delete();

        return response()->json(['message' => 'Empresa eliminada com sucesso!']);
    }
}
