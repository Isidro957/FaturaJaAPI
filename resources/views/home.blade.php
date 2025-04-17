@extends('layouts.dashboard')

@section('content')
<!-- Main Content -->
<main class="flex flex-col flex-1 p-3 md:p-4 lg:p-6 mt-14 md:mt-0">
    <!-- Header -->
    <div class="flex flex-col justify-between gap-3 mb-4 sm:flex-row sm:items-center md:mb-6">
        <h2 class="text-xl md:text-2xl font-bold text-[#0E3254] p-2 pt-5">Visão geral</h2>
        <div class="flex items-center justify-between w-full gap-2 sm:justify-end sm:gap-3 md:gap-5 sm:w-auto">
            <div class="relative flex-grow hidden sm:flex-grow-0 md:block">
                <input type="text" placeholder=""
                    class="w-full sm:w-40 md:w-48 lg:w-64 xl:w-80 px-3 py-2 bg-white border-gray-300 rounded-full focus:outline-[#0E3254] border shadow">
                <button type="" class="absolute transform -translate-y-1/2 right-3 top-1/2">
                    <i class="text-[#0E3254] fas fa-search"></i>
                </button>
            </div>

            <button
                class="relative items-center justify-center hidden w-8 h-8 text-gray-700 bg-white rounded-full md:h-9 md:w-9 md:flex">
                <a href="#">
                    <img src="{{ asset('assets/icones/notificação.svg') }}" alt="icone-notificacoes"
                        class="w-5 h-5 md:w-6 md:h-6">
                </a>
            </button>
            <div class="items-center justify-center hidden w-8 h-8 bg-white rounded-full md:flex md:w-10 md:h-10">
                <img src="{{ asset('assets/icones/wallpaperflare.com_wallpaper (1).jpg') }}" alt="Avatar"
                    class="w-[80%] h-[80%] rounded-full">
            </div>
        </div>
    </div>

    <!-- Cards Row -->
    <div
        class="grid grid-cols-1 gap-3 p-3 mb-4 bg-white border rounded-lg shadow sm:grid-cols-2 lg:grid-cols-4 md:gap-4 md:p-5 md:mb-6">
        <div class="relative flex h-auto min-h-[53px] p-3 md:p-4 bg-white border rounded-lg shadow-md">
            <div class="flex items-center justify-between w-full">
                <h3 class="text-sm md:text-base font-semibold text-[#0E3254]">Feedback do Supervisor</h3>
                <span
                    class="absolute -top-2 -right-2 flex items-center justify-center w-5 h-5 md:w-6 md:h-6 text-xs md:text-sm font-semibold text-white bg-[#0E3254] rounded-full shadow">
                    2
                </span>
            </div>
        </div>

        <div class="relative flex h-auto min-h-[53px] p-3 md:p-4 bg-white border rounded-lg shadow-md">
            <div class="flex items-center justify-between w-full">
                <h3 class="text-sm md:text-base font-semibold text-[#0E3254]">Aprovações ou Rejeições</h3>
                <span
                    class="absolute -top-2 -right-2 flex items-center justify-center w-5 h-5 md:w-6 md:h-6 text-xs md:text-sm font-semibold text-white bg-[#0E3254] rounded-full shadow">
                    2
                </span>
            </div>
        </div>

        <div class="relative p-3 md:p-4 flex h-auto min-h-[53px] bg-white border rounded-lg shadow-md">
            <div class="flex items-center justify-between w-full">
                <h3 class="text-sm md:text-base font-semibold text-[#0E3254]">Comunicados Gerais</h3>
                <span
                    class="absolute -top-2 -right-2 flex items-center justify-center w-5 h-5 md:w-6 md:h-6 text-xs md:text-sm font-semibold text-white bg-[#0E3254] rounded-full shadow">
                    1
                </span>
            </div>
        </div>

        <div class="relative p-3 md:p-4 flex h-auto min-h-[53px] bg-white border rounded-lg shadow-md">
            <div class="flex items-center justify-between w-full">
                <h3 class="text-sm md:text-base font-semibold text-[#0E3254]">Lembretes e Prazos</h3>
                <span
                    class="absolute -top-2 -right-2 flex items-center justify-center w-5 h-5 md:w-6 md:h-6 text-xs md:text-sm font-semibold text-white bg-[#0E3254] rounded-full shadow">
                    1
                </span>
            </div>
        </div>
    </div>

    <!-- Main Content Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 h-auto md:h-[calc(100vh-300px)] lg:h-[calc(100vh-240px)]">

        <div class="grid w-full h-full col-span-12 gap-3 lg:col-span-6">
            <div class="grid w-full grid-cols-1 gap-3 sm:grid-cols-2 m">
                <div class="flex items-center justify-center flex-1 col-span-6 p-4 bg-white rounded-lg shadow">
                    Bernarda
                </div>
            </div>

            <!-- div mencionada -->
            <div class="flex flex-col h-auto gap-2 p-3 bg-white rounded-lg shadow md:h-full md:p-4">
                <div class="flex flex-col flex-1 w-full gap-1 rounded-lg">
                    <div class="flex flex-col">
                        <h2 class="font-semibold text-[#0E3254] text-lg md:text-xl text-center p-2 md:p-4">
                            Resumo do Estágio</h2>
                        <div class="p-2">
                            <span class="text-sm font-semibold md:text-base text-slate-800">Horas trabalhadas:
                                <span class="text-[#0E3254] text-xs md:text-sm">120h/200h</span>
                            </span>
                            <div class="w-full h-2 bg-gray-100 rounded">
                                <div class="w-[55%] h-full bg-[#F69525] rounded"></div>
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <span class="text-sm font-semibold md:text-base text-slate-800">Actividades:
                            <span class="text-[#0E3254] bg-slate-200 rounded-lg p-1 text-xs md:text-sm">15
                                Enviadas</span>
                        </span>
                    </div>
                </div>

                <div class="flex flex-col flex-1 gap-4 px-3 py-3 rounded-lg md:gap-10 md:py-4 bg-slate-100">
                    <div class="flex flex-wrap gap-2 md:gap-3">
                        <div class="flex items-center gap-1">
                            <img src="{{ asset('assets/icones/positivo.svg') }}" alt="" class="w-3 h-3 md:w-4 md:h-4">
                            <span class="text-[#0E3254] font-semibold text-xs md:text-sm">Aprovadas: 12</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <img src="{{ asset('assets/icones/pendente.svg') }}" alt="" class="w-3 h-3 md:w-4 md:h-4">
                            <span class="text-[#0E3254] font-semibold text-xs md:text-sm">Pendentes: 10</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <img src="{{ asset('assets/icones/negado.svg') }}" alt="" class="w-3 h-3 md:w-4 md:h-4">
                            <span class="text-[#0E3254] font-semibold text-xs md:text-sm">Rejeitadas: 05</span>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <span class="text-sm font-semibold md:text-base text-slate-800">Previsão de Conclusão:
                            <span class="text-[#0E3254] rounded-lg p-1 text-xs md:text-sm">21/11/2025</span>
                        </span>
                        <span class="text-sm font-semibold md:text-base text-slate-800">Status:
                            <span class="text-[#0E3254] rounded-lg p-1 text-xs md:text-sm">Em Andamento</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="h-auto col-span-12 p-2 bg-white rounded-lg shadow md:h-full lg:col-span-6 md:p-3">
            <div class="grid grid-cols-1 gap-2 md:gap-3">
                <div
                    class="flex flex-col justify-between px-3 py-2 text-xs bg-gray-100 rounded-lg sm:flex-row sm:items-center md:px-4 md:py-3 md:text-sm hover:overflow-y-auto">
                    <span class="mb-1 sm:mb-0">24/02/2025 – Atualização do banco de dados (4h)</span>
                    <span class="flex items-center font-medium text-blue-900">
                        <span class="w-2 h-2 mr-2 rounded-full bg-amber-500"></span>
                        Status: Pendente
                    </span>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection