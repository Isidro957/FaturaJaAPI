<?php

namespace App\Http\Controllers;

use App\Models\Fatura;
use App\Models\Pagamento;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
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

    /** Exportar PDF de uma fatura */
    public function faturaPdf(Request $request, $id)
    {
        $user = $this->mapUser($request);
        $fatura = Fatura::with('itens', 'cliente')->findOrFail($id);

        if ($user->tipo !== 'Admin' &&
            !($user->tipo === 'Empresa' && $fatura->empresa_id == $user->empresa_id) &&
            !($user->tipo === 'Cliente' && $fatura->cliente_email == $user->email)) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        $pdf = Pdf::loadView('pdfs.fatura', ['fatura' => $fatura]);
        return $pdf->download("fatura-{$fatura->numero}.pdf");
    }

    /** Exportar Excel de uma fatura */
    public function faturaExcel(Request $request, $id)
    {
        $user = $this->mapUser($request);
        $fatura = Fatura::with('itens', 'cliente')->findOrFail($id);

        if ($user->tipo !== 'Admin' &&
            !($user->tipo === 'Empresa' && $fatura->empresa_id == $user->empresa_id) &&
            !($user->tipo === 'Cliente' && $fatura->cliente_email == $user->email)) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        $dados = [
            ['Número', $fatura->numero],
            ['Cliente', $fatura->cliente->nome],
            ['Email', $fatura->cliente->email],
            ['Data', $fatura->data_emissao],
            ['Total', $fatura->valor_total],
            [],
            ['Descrição', 'Qtd', 'Valor Unit.', 'Subtotal']
        ];

        foreach ($fatura->itens as $item) {
            $dados[] = [$item->descricao, $item->quantidade, $item->valor_unitario, $item->subtotal];
        }

        return Excel::download(new class($dados) implements \Maatwebsite\Excel\Concerns\FromArray {
            public function __construct(private $dados) {}
            public function array(): array { return $this->dados; }
        }, "fatura-{$fatura->numero}.xlsx");
    }

    /** Exportar todas faturas da empresa/Admin */
    public function todasFaturasExcel(Request $request)
    {
        $user = $this->mapUser($request);
        if ($user->tipo === 'Cliente') return response()->json(['message' => 'Não autorizado.'], 403);

        $query = Fatura::with('cliente');
        if ($user->tipo === 'Empresa') $query->where('empresa_id', $user->empresa_id);

        $faturas = $query->get();

        $dados = [['Número', 'Cliente', 'Email', 'Data', 'Total', 'Status']];
        foreach ($faturas as $f) {
            $dados[] = [$f->numero, $f->cliente->nome ?? '', $f->cliente->email ?? '', $f->data_emissao, $f->valor_total, $f->status];
        }

        return Excel::download(new class($dados) implements \Maatwebsite\Excel\Concerns\FromArray {
            public function __construct(private $dados) {}
            public function array(): array { return $this->dados; }
        }, 'todas-faturas.xlsx');
    }

    /** Exportar PDF de pagamento */
    public function pagamentoPdf(Request $request, $id)
    {
        $user = $this->mapUser($request);
        $pagamento = Pagamento::findOrFail($id);

        if ($user->tipo !== 'Admin' && !($user->tipo === 'Empresa' && $pagamento->empresa_id == $user->empresa_id)) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        $pdf = PDF::loadView('pdfs.pagamento', ['pagamento' => $pagamento]);
        return $pdf->download("pagamento-{$pagamento->id}.pdf");
    }

    /** Exportar Excel de pagamento */
    public function pagamentoExcel(Request $request, $id)
    {
        $user = $this->mapUser($request);
        $pagamento = Pagamento::findOrFail($id);

        if ($user->tipo !== 'Admin' && !($user->tipo === 'Empresa' && $pagamento->empresa_id == $user->empresa_id)) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        $dados = [
            ['ID', 'Cliente', 'Valor', 'Data', 'Status'],
            [$pagamento->id, $pagamento->cliente->nome ?? '', $pagamento->valor, $pagamento->data, $pagamento->status]
        ];

        return Excel::download(new class($dados) implements \Maatwebsite\Excel\Concerns\FromArray {
            public function __construct(private $dados) {}
            public function array(): array { return $this->dados; }
        }, "pagamento-{$pagamento->id}.xlsx");
    }
}
