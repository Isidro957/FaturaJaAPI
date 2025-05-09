@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-4 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">Cadastrar Documento</h2>

    <form action="{{ url('documentos/create') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="mb-3">
            <label class="block">Título</label>
            <input type="text" name="titulo_doc" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block">Arquivo</label>
            <input type="file" name="arquivo_doc" class="w-full border p-2 rounded" >
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Salvar</button>
    </form>
</div>
<!-- @if ($errors->any())
<div class="">
    <ul>
        @foreach ($errors->all() as $erro)
        <li>{{ $erro }}</li>
        @endforeach
    </ul>
</div>
@endif -->

@endsection