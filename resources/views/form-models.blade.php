@extends('layouts.dashboard')

@section('content')
<!-- Main Content -->
<main class="flex flex-col items-center justify-center flex-1 gap-5 p-3 gap i md:p-4 lg:p-6 mt-14 md:mt-0">
    <form action="#" class="h-auto box-style ">
        <h2 class="section-title">Form Model (without labels)</h2>

        <div class="flex flex-col gap-2">
            <div class="in-line">
                <input type="text" name="nome" class="form-inputs" placeholder="type name...">
                <input type="email" name="email" class="form-inputs" placeholder="type email...">
                <input type="password" name="senha" class="form-inputs" placeholder="type senha...">
            </div>

            <div class="in-line">
                <input type="datetime-local" name="exemplo1" class="form-inputs" placeholder="texto exemplo...">
                <input type="time" name="exemplo2" class="form-inputs" placeholder="texto exemplo...">
            </div>
            <input type="tel" name="exemplo2" class="form-inputs" placeholder="type tel...">
        </div>

        <h2 class="section-title">Form Model (with labels)</h2>

        <div class="flex flex-col gap-2">
            <div class="items-start in-line">
                <div class="with-labels">
                    <label for="name" class="form-labels">Name</label>
                    <input type="text" id="name" name="nome" class="form-inputs" placeholder="type name...">
                </div>

                <div class="with-labels">
                    <label for="email" class="form-labels">E-mail</label>
                    <input type="email" id="email" name="email" class="form-inputs" placeholder="type email...">
                </div>

                <div class="with-labels">
                    <label for="senha" class="form-labels">Senha</label>
                    <input type="password" id="senha" name="senha" class="form-inputs" placeholder="type senha...">
                </div>
            </div>

            <div class="items-start in-line">
                <div class="with-labels">
                    <label for="data-hora" class="form-labels">Data/Hora</label>
                    <input type="datetime-local" id="data-hora" name="data-hora" class="form-inputs">
                </div>

                <div class="with-labels">
                    <label for="Hora" class="form-labels">Hora</label>
                    <input type="time" id="Hora" name="Hora" class="form-inputs">
                </div>
            </div>
            
            <div class="with-labels">
                <label for="Telefone" class="form-labels">Telefone</label>
                <input type="tel" id="Telefone" name="Telefone" class="form-inputs" placeholder="type tel...">
            </div>
        </div>
    </form>
</main>

@endsection