<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\Organizacoes;
use App\Models\Documentos;
use App\Models\User;
use App\Http\Requests\UploadFormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class DocumentosController extends Controller
{

    // Autenticação obrigatória
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $documentos = Documentos::all();
        #dd($documentos);
        return view('documentos.listar', compact('documentos'));
    }
    //Criar documento
    public function create()
    {
        return view('documentos.create');
    }

    //Armazenar documento criptografado
    public function store(UploadFormRequest $request)
    {
        $documentos = new Documentos;
        $documentos->org_id = 1;
        $documentos->titulo_doc = $request->get('titulo_doc');

        if ($request->hasFile('arquivo_doc')) {
            $file = $request->file('arquivo_doc');

            $conteudoArquivo = file_get_contents($file);

            // Criptografar conteúdo
            $criptografado = encrypt($conteudoArquivo);
            $nomeArquivo = time() . '_' . $file->getClientOriginalName() . '.enc';
            Storage::disk('public')->put('documentos_criptografados/' . $nomeArquivo, $criptografado);

            // Gerar o hash no nome do arquivo para salvar na bd
            $hash = Crypt::encryptString($nomeArquivo);
            $documentos->arquivo_doc = $hash;

            $documentos->save();
            return redirect()->route('documentos.listar');
        }
    }

    public function visualizar($hash)
    {
        try {

            // Descriptografar o nome do arquivo
            $nomeArquivo = Crypt::decryptString($hash);
            $caminho = storage_path('app/public/documentos_criptografados/' . $nomeArquivo);

            if (!file_exists($caminho)) {
                abort(404, 'Arquivo não encontrado.');
            }

            // Descriptografar o conteúdo
            $conteudo = decrypt(file_get_contents($caminho));

            // Detectar tipo MIME do conteúdo real
            $tipoMime = finfo_buffer(finfo_open(), $conteudo, FILEINFO_MIME_TYPE);

            return response($conteudo, 200)
                ->header('Content-Type', $tipoMime)
                ->header('Content-Disposition', 'inline; filename="' . pathinfo($nomeArquivo, PATHINFO_FILENAME) . '"');
        } catch (\Exception $e) {
            abort(403, 'URL inválida ou arquivo corrompido.');
        }
    }

    //Baixar documento
    /* public function download($id)
    {
        $documentos = Documentos::findOrFail($id);

        // Obtém o caminho do arquivo criptografado
        $path = $documentos->arquivo_doc;

        // Retorna o arquivo criptografado (não descriptografado, apenas o arquivo criptografado)
        return response()->download(storage_path('app/' . $path));
    } */

    public function show(string $id)
    {
        //
    }

    //Editar documento
    public function edit($id)
    {
        $documentos = Documentos::where('id', $id)->firstOrFail();
        #dd($documento );
        return view('documentos.editar', ['documentos' => $documentos]);
    }

    //Actualizar documento
    public function update(UploadFormRequest $request, $id)
    {
        // Encontre o documento com base no ID
        $documentos = Documentos::findOrFail($id);

        // Atualize os dados do documento
        $documentos->titulo_doc = $request->get('titulo_doc');

        // Verifique se o arquivo foi enviado e faça o upload
        if ($request->hasFile('arquivo_doc')) {
            // Verifique se já existe um arquivo anterior para deletar
            $oldFile = $documentos->arquivo_doc;
            if (Storage::disk('public')->exists('documentos/' . $oldFile)) {
                Storage::disk('public')->delete('documentos/' . $oldFile);
            }

            // Salve o novo arquivo
            $file = $request->file('arquivo_doc');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('documentos', $filename, 'public');
            $documentos->arquivo_doc = $path; // Atualiza o campo com o novo arquivo
        }

        // Salve as alterações no banco de dados
        if ($documentos->save()) {
            return redirect()->route('documentos.listar')->with('success', 'Documento atualizado com sucesso!');
        } else {
            return back()->with('error', 'Erro ao atualizar o documento.');
        }
    }

    //Visualizar documento
    /*   public function mostrar($nome)
    {
        try {
            $nomeDesencriptado = Crypt::decryptString($nome);
            $caminho = storage_path('app/public/documentos/' . $nomeDesencriptado);

            if (!file_exists($caminho)) {
                abort(404, 'Documento não encontrado.');
            }

            return response()->file($caminho);
        } catch (\Exception $e) {
            abort(403, 'URL inválida ou manipulada.');
        }
    } */

    //Remover documento
    public function destroy(string $id)
    {
        $documentos = Documentos::findOrFail($id);
        $documentos->delete();

        return redirect()->route('documentos.listar')->with('success', 'Documento atualizado com sucesso!');
    }
}
