@extends('layouts.dashboard')

@section('content')
<!-- Main Content -->
<main class="flex flex-col items-center justify-center flex-1 gap-5 p-3 gap i md:p-4 lg:p-6 mt-14 md:mt-0">
    <table class="box-style min-w-[600px] table-auto">
        <thead>
            <th class="table-heade-item">Actividade</th>
            <th class="table-heade-item">Data início</th>
            <th class="table-heade-item">Data fim</th>
            <th class="table-heade-item">Status</th>
        </thead>
        <tbody>
            <tr class="table-rows">
                <td class="table-body-item ">Levantar requisitos</td>
                <td class="table-body-item">10/02/2025</td>
                <td class="table-body-item">20/02/2025</td>
                <td class="table-body-item">Concluído</td>
            </tr>

            <tr class="table-rows">
                <td class="table-body-item">Desenvolver as interfaces d usuário</td>
                <td class="table-body-item">01/03/2025</td>
                <td class="table-body-item">23/03/2025</td>
                <td class="table-body-item">Concluído</td>
            </tr>

            <tr class="table-rows">
                <td class="table-body-item">Interligar o front-end ao back-end</td>
                <td class="table-body-item">25/03/2025</td>
                <td class="table-body-item">03/04/2025</td>
                <td class="table-body-item">Concluído</td>
            </tr>

            <tr class="table-rows">
                <td class="table-body-item">Criar bases de dados</td>
                <td class="table-body-item">05/04/2025</td>
                <td class="table-body-item">20/04/2025</td>
                <td class="table-body-item">Concluído</td>
            </tr>

            <tr class="table-rows">
                <td class="table-body-item">Realizar testes</td>
                <td class="table-body-item">25/04/2025</td>
                <td class="table-body-item">15/05/2025</td>
                <td class="table-body-item">Pendente</td>
            </tr>
        </tbody>
    </table>
</main>

@endsection