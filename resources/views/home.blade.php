@extends('layouts.dashboard')

@section('content')

<div class="flex flex-col flex-1 overflow-auto">
    <x-ui.header />

    <main class="flex-1 p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Cards -->
            <div
                class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-gray-300 flex flex-col justify-between">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-base text-gray-500 mb-1">Entradas</p>
                        <h2 class="text-2xl font-bold">4</h2>
                    </div>
                    <div class="h-14 w-14 rounded-full bg-gray-50 flex items-center justify-center">
                        <i data-lucide="file-input" class="text-gray-500 w-7 h-7"></i>
                    </div>
                </div>
                <div class="flex items-center text-xs mb-3">
                    <!-- 
                             <span class="text-green-500 font-medium">-18%</span>
                            <span class="text-gray-400 ml-1">vs. mês anterior</span>
                            -->
                </div>
                <button
                    class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded text-sm transition-colors flex items-center justify-center">
                    <span>Ver detalhes</span>
                    <i data-lucide="chevron-right" class="ml-1 w-4 h-4"></i>
                </button>
            </div>

            <div
                class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-gray-300 flex flex-col justify-between">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-base text-gray-500 mb-1">Saídas</p>
                        <h2 class="text-2xl font-bold">7</h2>
                    </div>
                    <div class="h-14 w-14 rounded-full bg-gray-50 flex items-center justify-center">
                        <i data-lucide="file-output" class="text-gray-500 w-7 h-7"></i>
                    </div>
                </div>
                <div class="flex items-center text-xs mb-3">
                    <!-- 
                            <span class="text-green-500 font-medium">-18%</span>
                            <span class="text-gray-400 ml-1">vs. mês anterior</span> 
                            -->
                </div>
                <button
                    class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded text-sm transition-colors flex items-center justify-center">
                    <span>Ver detalhes</span>
                    <i data-lucide="chevron-right" class="ml-1 w-4 h-4"></i>
                </button>
            </div>

            <div
                class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-gray-300 flex flex-col justify-between">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-base text-gray-500 mb-1">Arquivados</p>
                        <h2 class="text-2xl font-bold">5</h2>
                    </div>
                    <div class="h-14 w-14 rounded-full bg-gray-50 flex items-center justify-center">
                        <i data-lucide="archive" class="text-gray-500 w-7 h-7"></i>
                    </div>
                </div>
                <div class="flex items-center text-xs mb-3">
                    <!-- 
                            <span class="text-green-500 font-medium">-18%</span>
                            <span class="text-gray-400 ml-1">vs. mês anterior</span> 
                            -->
                </div>
                <button
                    class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded text-sm transition-colors flex items-center justify-center">
                    <span>Ver detalhes</span>
                    <i data-lucide="chevron-right" class="ml-1 w-4 h-4"></i>
                </button>
            </div>
        </div>

        <div class="flex flex-col mt-10">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg divide-y divide-gray-200">
                        <div class="py-3 px-4">
                            <div class="relative max-w-xs">
                                <label for="hs-table-search" class="sr-only">Search</label>
                                <input type="text" name="hs-table-search" id="hs-table-search" class="inputs" placeholder="Pesquisar documento">

                                <div
                                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                    <i data-lucide="search" class="text-gray-400 size-4"></i>
                                </div>
                            </div>
                        </div>

                        <div class="overflow-hidden">
                            <!-- TABELA -->
                            <x-table.table>
                                <x-slot:head>
                                    <th class="t-header">Cargo</th>
                                    <th class="t-header">Nome</th>
                                    <th class="t-header">Email</th>
                                    <th class="t-header">idade</th>
                                </x-slot:head>

                                <x-slot:body>
                                    <x-table.row>
                                        <td class="t-cell">Dev Front-End</td>
                                        <td class="t-cell">Stelvio Marques</td>
                                        <td class="t-cell">stelviomarques157@gmail.com</td>
                                        <td class="t-cell">19</td>
                                    </x-table.row>

                                    <x-table.row>
                                        <td class="t-cell">Dev Back-End</td>
                                        <td class="t-cell">Paulina Capitão</td>
                                        <td class="t-cell">capitaopaulinafernando@gmail.com</td>
                                        <td class="t-cell">17</td>
                                    </x-table.row>

                                    <x-table.row>
                                        <td class="t-cell">Dev Back-End</td>
                                        <td class="t-cell">Joaquim Marcial</td>
                                        <td class="t-cell">marcialmbango@gmail.com</td>
                                        <td class="t-cell">39</td>
                                    </x-table.row>
                                </x-slot:body>
                            </x-table.table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-ui.notification-panel />
</div>

@endsection