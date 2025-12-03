<?php

namespace App\Http\Controllers;

use App\Models\Fatura;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\FaturaEnviadaMail;
use Barryvdh\DomPDF\Facade\Pdf;

class FaturaController extends Controller
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

    protected function getNextFaturaNumber(int $empresaId): string
    {
        $lastFatura = Fatura::where('empresa_id', $empresaId)
            ->orderBy('numero', 'desc')
            ->first();

        $newNumber = $lastFatura
            ? intval(substr($lastFatura->numero, -5)) + 1
            : 1;

        $year = now()->format('Y');
        return "FT-{$year}/" . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }

    public function index(Request $request)
    {
        $user = $this->mapUser($request);
        $query = Fatura::with(['cliente', 'itens.produto']);

        if ($user->tipo === 'Admin') return response()->json($query->latest()->get());
        if ($user->tipo === 'Empresa') return response()->json($query->where('empresa_id', $user->empresa_id)->latest()->get());
        if ($user->tipo === 'Cliente') return response()->json($query->where('cliente_email', $user->email)->latest()->get());

        return response()->json(['message' => 'Não autorizado.'], 403);
    }

    public function show(Request $request, Fatura $fatura)
    {
        $user = $this->mapUser($request);

        if ($user->tipo === 'Admin' ||
            ($user->tipo === 'Empresa' && $fatura->empresa_id == $user->empresa_id) ||
            ($user->tipo === 'Cliente' && $fatura->cliente_email == $user->email)) {
            return response()->json($fatura->load(['itens', 'cliente']));
        }

        return response()->json(['message' => 'Não autorizado.'], 403);
    }

    public function store(Request $request)
    {
        $user = $this->mapUser($request);
        if ($user->tipo !== 'Empresa') return response()->json(['message' => 'Apenas empresas podem emitir faturas.'], 403);

        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'data_emissao' => 'required|date',
            'data_vencimento' => 'nullable|date|after_or_equal:data_emissao',
            'itens' => 'required|array|min:1',
            'itens.*.quantidade' => 'required|integer|min:1',
            'itens.*.valor_unitario' => 'required|numeric|min:0',
            'itens.*.produto_id' => 'nullable|exists:produtos,id',
            'itens.*.descricao' => 'nullable|string|max:255',
        ]);

        $cliente = Cliente::findOrFail($request->cliente_id);
        if ($cliente->empresa_id !== $user->empresa_id) {
            return response()->json(['message' => 'Cliente não pertence à sua empresa.'], 403);
        }

        $fatura = DB::transaction(function() use ($request, $user, $cliente) {
            $subtotal = 0;
            $itens = [];

            foreach ($request->itens as $item) {
                $linhaSubtotal = $item['quantidade'] * $item['valor_unitario'];
                $subtotal += $linhaSubtotal;

                $itens[] = [
                    'produto_id' => $item['produto_id'] ?? null,
                    'descricao' => $item['descricao'] ?? 'Produto/Serviço',
                    'quantidade' => $item['quantidade'],
                    'valor_unitario' => $item['valor_unitario'],
                    'subtotal' => $linhaSubtotal,
                    'imposto' => 0,
                    'valor_desconto_unitario' => 0,
                ];
            }

            $fatura = Fatura::create([
                'empresa_id' => $user->empresa_id,
                'cliente_id' => $cliente->id,
                'numero' => $this->getNextFaturaNumber($user->empresa_id),
                'data_emissao' => $request->data_emissao,
                'data_vencimento' => $request->data_vencimento,
                'valor_subtotal' => $subtotal,
                'valor_total' => $subtotal,
                'nif_cliente' => $cliente->nif,
                'status' => 'pendente',
                'tipo' => 'fatura',
            ]);

            $fatura->itens()->createMany($itens);
            return $fatura->load(['itens', 'cliente']);
        });

        // Gerar PDF
        $pdf = Pdf::loadView('pdfs.fatura', ['fatura' => $fatura]);
        $nomeArquivo = "fatura-{$fatura->numero}.pdf";
        Storage::put("public/faturas/empresa-{$user->empresa_id}/{$nomeArquivo}", $pdf->output());

        $fatura->arquivo_pdf = "empresa-{$user->empresa_id}/{$nomeArquivo}";
        $fatura->save();

        // Enviar e-mail
        if ($cliente->email) {
            Mail::to($cliente->email)->queue(new FaturaEnviadaMail($fatura));
        }

        return response()->json(['message' => 'Fatura emitida e enviada.', 'fatura' => $fatura], 201);
    }

    public function destroy(Request $request, Fatura $fatura)
    {
        $user = $this->mapUser($request);

        if ($user->tipo !== 'Admin' && !($user->tipo === 'Empresa' && $fatura->empresa_id == $user->empresa_id)) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        if ($fatura->arquivo_pdf) Storage::delete("public/faturas/{$fatura->arquivo_pdf}");
        $fatura->delete();

        return response()->json(['message' => 'Fatura eliminada com sucesso!']);
    }
}
