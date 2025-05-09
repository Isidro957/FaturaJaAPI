@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto p-4 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">Editar o Cadastro de Documento</h2>

    <form action="{{ route('documentos.update', $documentos->id) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('PUT')

        <div class="mb-3">
            <label class="block">Título</label>
            <input type="text" name="titulo_doc" class="w-full border p-2 rounded" value="{{ old('titulo_doc', $documentos->titulo_doc) }}" required>
        </div>

        <!-- Link para visualizar ou baixar o documento atual -->
        <div class="mb-4">
            @if($documentos->arquivo_doc)
            <a href="{{ asset('storage/' . $documentos->arquivo_doc) }}" target="_blank">
                Visualizar documento atual
            </a>


            @endif
        </div>

        <!-- Campo para substituir o documento -->
        <div class="mb-4">
            <label for="documento" class="block mb-2 text-sm font-medium text-gray-700">Novo Documento:</label>
            <input type="file" name="arquivo_doc" id="arquivo_doc" class="border rounded p-2 w-full">
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('documentos.listar') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-md mr-3">
                Cancelar
            </a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md">
                Salvar Alterações
            </button>
        </div>
    </form>
</div>
</form>
</div>

@endsection