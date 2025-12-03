<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Models\Fatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PagamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth0.jwt');
    }

    private function mapUser(Request $request)
    {
        $decoded = $request->get('user_auth0');
        $empresaId = $request->get('empresa_id');

        return (object)[
            'email' => $decoded['email'] ?? null,
            'tipo' => $decoded['https://meusistema.com/role'] ?? 'cliente',
            'empresa_id' => $empresaId,
        ];
    }

    private function checkAccess($usuario)
    {
        if (!in_array($usuario->tipo, ['Admin', 'empresa'])) {
            abort(403, 'Acesso não autorizado. Apenas administradores e empresas podem gerir pagamentos.');
        }
    }

    public function index(Request $request)
    {
        $usuario = $this->mapUser($request);
        $this->checkAccess($usuario);

        $query = Pagamento::with(['fatura.cliente', 'fatura']);

        if ($usuario->tipo === 'empresa') {
            $query->where('empresa_id', $usuario->empresa_id);
        }

        return response()->json($query->latest()->get());
    }

    public function store(Request $request)
    {
        $usuario = $this->mapUser($request);
        $this->checkAccess($usuario);

        $validatedData = $request->validate([
            'fatura_id' => 'required|exists:faturas,id',
            'valor_pago' => 'required|numeric|min:0',
            'valor_desconto' => 'nullable|numeric|min:0',
            'data_pagamento' => 'required|date',
            'valor_troco' => 'nullable|numeric|min:0',
            'metodo_pagamento' => 'required|string|in:pix,cartao,boleto,transferencia,dinheiro',
            'referencia' => 'nullable|string|max:100',
        ]);

        if (($validatedData['valor_pago'] ?? 0) <= 0 && ($validatedData['valor_desconto'] ?? 0) <= 0) {
            throw ValidationException::withMessages([
                'valor_pago' => 'É necessário fornecer um valor pago ou um valor de desconto maior que zero.',
            ]);
        }

        return DB::transaction(function () use ($validatedData, $usuario, $request) {
            $fatura = Fatura::findOrFail($validatedData['fatura_id']);

            if ($usuario->tipo === 'empresa' && $fatura->empresa_id != $usuario->empresa_id) {
                abort(403, 'Não tem permissão para registar pagamentos para faturas de outras empresas.');
            }

            if (in_array($fatura->status, ['pago', 'cancelado'])) {
                throw ValidationException::withMessages([
                    'fatura_id' => 'Não é possível registrar pagamentos para uma fatura com status: ' . $fatura->status,
                ]);
            }

            $totalPagoAnteriormente = $fatura->pagamentos()->sum(DB::raw('valor_pago + valor_desconto'));
            $saldoDevedor = $fatura->valor_total - $totalPagoAnteriormente;
            $reducaoLiquida = ($validatedData['valor_pago'] ?? 0) + ($validatedData['valor_desconto'] ?? 0);

            if ($reducaoLiquida > $saldoDevedor) {
                throw ValidationException::withMessages([
                    'valor_pago' => 'A soma do valor pago e do desconto excede o saldo devedor. Saldo restante: ' . number_format($saldoDevedor, 2, ',', '.') . '.',
                ]);
            }

            $pagamento = Pagamento::create([
                ...$validatedData,
                'empresa_id' => $fatura->empresa_id,
                'referencia' => $request->referencia ?? null,
            ]);

            // Atualiza status da fatura
            $novoTotalPago = $totalPagoAnteriormente + $reducaoLiquida;
            $novoStatus = 'pendente';

            if (abs($novoTotalPago - $fatura->valor_total) < 0.01 || $novoTotalPago > $fatura->valor_total) {
                $novoStatus = 'pago';
            } elseif ($novoTotalPago > 0) {
                $novoStatus = 'parcialmente_pago';
            }

            $fatura->update(['status' => $novoStatus]);

            return response()->json($pagamento->load('fatura'), 201);
        });
    }

    public function show(Request $request, $id)
    {
        $usuario = $this->mapUser($request);
        $this->checkAccess($usuario);

        $pagamento = Pagamento::with('fatura')->findOrFail($id);

        if ($usuario->tipo === 'empresa' && $pagamento->empresa_id != $usuario->empresa_id) {
            abort(403, 'Não tem permissão para aceder a este pagamento.');
        }

        return response()->json($pagamento);
    }

    public function update(Request $request, Pagamento $pagamento)
    {
        return response()->json(['message' => 'Pagamentos não podem ser alterados diretamente. Exclua e registre um novo.'], 405);
    }

    public function destroy(Request $request, $id)
    {
        $usuario = $this->mapUser($request);
        $this->checkAccess($usuario);

        $pagamento = Pagamento::with('fatura')->findOrFail($id);

        if ($usuario->tipo === 'empresa' && $pagamento->empresa_id != $usuario->empresa_id) {
            abort(403, 'Não tem permissão para eliminar pagamentos desta empresa.');
        }

        $fatura = $pagamento->fatura;

        return DB::transaction(function () use ($pagamento, $fatura) {
            $pagamento->delete();

            $totalPagoAposDelete = $fatura->pagamentos()->sum(DB::raw('valor_pago + valor_desconto'));
            $novoStatus = 'pendente';

            if (abs($totalPagoAposDelete - $fatura->valor_total) < 0.01 || $totalPagoAposDelete > $fatura->valor_total) {
                $novoStatus = 'pago';
            } elseif ($totalPagoAposDelete > 0) {
                $novoStatus = 'parcialmente_pago';
            }

            $fatura->update(['status' => $novoStatus]);

            return response()->json(['message' => 'Pagamento eliminado e status da fatura atualizado com sucesso!'], 204);
        });
    }
}
