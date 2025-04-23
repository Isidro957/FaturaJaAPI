@extends('layouts.dashboard')

@section('content')
<main class="flex flex-col flex-1 p-3 overflow-y-auto md:p-4 lg:p-6 mt-14 md:mt-0">
    <div class="max-w-6xl p-6 mx-auto bg-white rounded-lg shadow-md">
        <h1 class="mb-6 text-2xl font-medium text-center text-gray-500 md:text-3xl">FORMULÁRIO DE INSCRIÇÃO DA ORGANIZAÇÃO</h1>

        <form action="{{ url('organization/create') }}" method="post" enctype="multipart/form-data" id="form-registro"
		      class="flex flex-col gap-2 p-5 bg-white rounded-lg shadow-md lg:w-[50%] md:w-[80%] sm:w-[90%] w-[90%] border py-5">
		        {{ csrf_field() }}
            <!-- Row 1 -->
            <div class="space-y-2">
                <label class="block text-gray-500">Nome:</label>
                <input type="text" placeholder="Digite o nome" name="name_org" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            <div class="space-y-2">
                <label class="block text-gray-500">Nif:</label>
                <input type="text" placeholder="Digite o nif" name="nif_org" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            <div class="space-y-2">
                <label class="block text-gray-500">Regime da organização:</label>
                <select type="text" required  name="regime_org" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <option value="">Selecionar</option>
                    <option value="Regime Geral">Regime Geral</option>
                    <option value="Regime Simplificado">Regime Simplificado</option>
                    <option value="Regime Especial">Regime Especial (Microempresas e Startups)</option>
                </select>
            </div>

            <div class="space-y-2">
                <label class="block text-gray-500">Número de telefone:</label>
                <input type="text" placeholder="Digite o número de telefone" required  name="telefone_org" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            <div class="space-y-2">
                <label class="block text-gray-500">Email:</label>
                <input type="text" placeholder="Digite o número de telefone" required  name="email_org" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            <div class="space-y-2">
                <label class="block text-gray-500">Província (Sede):</label>
                <input type="text" placeholder="Digite a sede" required  name="provincia_org" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            <!-- Row 4 -->
            <div class="space-y-2">
                <label class="block text-gray-500">Logótipo:</label>
                <div class="flex">
                    <label class="w-full px-3 py-2 bg-white border border-gray-300 rounded cursor-pointer hover:bg-gray-50">
                        <span class="text-gray-500">Escolher ficheiro</span>
                        <input type="file" name="logo_org">
                    </label>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-gray-500">Descrição:</label>
                <div class="flex">
                    <label class="w-full px-3 py-2 bg-white border border-gray-300 rounded cursor-pointer hover:bg-gray-50">
                        <textarea type="text" rows="3" cols="" name="descricao_org" value="{{old('descricao_doc')}}" placeholder="Descrição do documento" required=""></textarea>

                    </label>
                </div>
                @if ($errors->has('descricao_org'))
                    <span class="alert-danger">
                        {{ $errors->first('descricao_org') }}
                    </span>
                @endif
            </div>

            <!-- Buttons -->
            <div class="flex flex-col items-center gap-2 mt-5">
              <button
                class="px-3 py-2 font-semibold border rounded-lg bg-[#0E3254] hover:bg-[#12416d] transition-colors duration-300 text-white w-full">Registrar
              </button>
            </div>

        </form>


    </div>
</main>
@endsection
