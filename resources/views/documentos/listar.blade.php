@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
    <form action="{{ url('documentos/create') }}" class="mb-4 ">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Dar entrada 📄</button>
    </form>
    <div class="bg-white shadow-md rounded-2xl p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Lista de Documentos</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-xl overflow-hidden">
                <thead class="bg-blue-100 text-blue-800 uppercase text-sm font-semibold">
                    <tr>
                        <th class="py-3 px-6 text-left">Título</th>
                        <th class="py-3 px-6 text-left">Organização</th>
                        <th class="py-3 px-6 text-left">Ficheiro</th>
                        <th class="py-3 px-6 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-100">
                    @foreach($documentos as $doc)
                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                        <td class="py-4 px-6">{{ $doc->titulo_doc }}</td>
                        <td class="py-4 px-6">{{ $doc->organizacao->nome ?? 'SDOCA' }}</td>
                        <td class="py-4 px-6">

                            <a href="{{ route('documentos.visualizar', ['hash' => $doc->arquivo_doc]) }}" target="_blank"
                                class=" text-blue-600 hover:underline font-medium"
                                target="_blank">
                                Ver Documento
                            </a>
                        </td>
                        <td class="py-4 px-6 flex space-x-3">
                            <a href="{{ route('documentos.editar', $doc->id) }}"
                                class="bg-blue-900 hover:bg-blue-900 text-white font-semibold py-1 px-3 rounded-md text-sm transition">
                                Editar
                            </a>
                            <form action="{{ route('documentos.destroy', $doc->id) }}" method="POST"
                                onsubmit="return confirm('Tens certeza que queres excluir este documento?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded-md text-sm transition">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @if($documentos->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center py-6 text-gray-400 italic">
                            Nenhum documento encontrado.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection