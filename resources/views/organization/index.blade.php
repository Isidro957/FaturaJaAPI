@extends('layouts.dashboard')

@section('content')
<div class="flex items-center justify-center h-full bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="mb-6 text-2xl font-semibold text-center">TABELA PARA LISTAR OS DADOS DA INSTITUIÇÕES</h2>

        @foreach ($organizacoes as $key => $value)
            {{ $value->name_org }}

            <img src="{{ asset('storage/'.$value->logo_org) }}" alt="{{ $value->name_org }}" width="100">
        @endforeach


    </div>
</div>
@endsection
