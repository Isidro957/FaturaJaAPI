<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="h-screen bg-gray-100">
    <div class="relative flex flex-col w-full h-full md:flex-row">
        <!-- Mobile Menu Toggle -->
        <div class="fixed z-50 flex items-center justify-between w-full p-1 bg-white border shadow md:hidden">
            <button id="menu-btn-open" class=" p-2 text-3xl l md:hidden text-[#0E3254] ">
                <i class="fa fa-bars"></i>
            </button>

            <div class="flex items-center gap-2">
                <button
                    class="relative flex items-center justify-center w-8 h-8 text-gray-700 bg-white rounded-full md:h-9 md:w-9">
                    <a href="#">
                        <img src="{{ asset('assets/icones/notificação.svg') }}" alt="icone-notificacoes"
                            class="w-6 h-6 md:w-6 md:h-6">
                    </a>
                </button>

                <div class="flex items-center justify-center w-10 h-10 bg-white rounded-full md:w-10 md:h-10">
                    <img src="{{ asset('assets/icones/wallpaperflare.com_wallpaper (1).jpg') }}" alt="Avatar"
                        class="w-[80%] h-[80%] rounded-full">
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed w-[80%] hidden h-full overflow-y-auto bg-white shadow-md md:block md:relative md:w-56 lg:w-[280px] p-3 z-50">
            <div class="flex items-center justify-between w-full">
                <div class="p-4 md:p-6">
                    <h1 class="text-xl font-bold text-[#0E3254] md:text-2xl">Portal do Estagiário</h1>
                </div>
                <button class="text-[#0E3254] rounded-full md:hidden ">
                    <i class="text-3xl fas fa-close" id="menu-btn-close"></i>
                </button>
            </div>

            <nav class="mt-2">
                <ul>
                    <li class="mb-1">
                        <a href="/home" class="flex items-center gap-3 px-4 py-3 rounded-lg menu-item hover:bg-gray-100"
                            data-img-default="{{ asset('assets/icones/icones dasboard/pagina inicial/Home/home_inativo.svg') }}"
                            data-img-hover="{{ asset('assets/icones/icones dasboard/pagina inicial/Home/home_ativo.svg') }}"
                            data-page="home">
                            <img src="{{ asset('assets/icones/icones dasboard/pagina inicial/Home/home_inativo.svg') }}"
                                alt="Home" class="w-5 h-5 md:w-6 md:h-6 menu-icon">
                            <span class="text-[#0E3254] font-semibold text-sm md:text-base">Página inicial</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="/registrar-actividade"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg menu-item hover:bg-gray-100"
                            data-img-default="{{ asset('assets/icones/icones dasboard/pagina inicial/Registro de Atividades/inativo.svg')}}"
                            data-img-hover="{{ asset('assets/icones/icones dasboard/pagina inicial/Registro de Atividades/ativo.svg')}}"
                            data-page="registro">
                            <img src="{{ asset('assets/icones/icones dasboard/pagina inicial/Registro de Atividades/inativo.svg')}}"
                                alt="" class="w-5 h-5 md:w-6 md:h-6 menu-icon">
                            <span class="text-[#0E3254] font-semibold text-sm md:text-base">Atividades</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="/historico-actividades"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg menu-item hover:bg-gray-100"
                            data-img-default="{{ asset('assets/icones/icones dasboard/pagina inicial/Histórico de Actividade/inativo.svg')}}"
                            data-img-hover="{{ asset('assets/icones/icones dasboard/pagina inicial/Histórico de Actividade/ativo.svg')}}"
                            data-page="historico">
                            <img src="{{ asset('assets/icones/icones dasboard/pagina inicial/Histórico de Actividade/inativo.svg')}}"
                                alt="" class="w-5 h-5 md:w-6 md:h-6 menu-icon">
                            <span class="text-[#0E3254] font-semibold text-sm md:text-base">Histórico do
                                Estagiário</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="/relatorio-estagiario"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg menu-item hover:bg-gray-100"
                            data-img-default="{{ asset('assets/icones/icones dasboard/pagina inicial/Relatorios/inativo.svg')}}"
                            data-img-hover="{{ asset('assets/icones/icones dasboard/pagina inicial/Relatorios/ativo.svg')}}"
                            data-page="relatorios">
                            <img src="{{ asset('assets/icones/icones dasboard/pagina inicial/Relatorios/inativo.svg')}}"
                                alt="" class="w-5 h-5 md:w-6 md:h-6 menu-icon">
                            <span class="text-[#0E3254] font-semibold text-sm md:text-base">Relatórios</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg menu-item hover:bg-gray-100"
                            data-img-default="{{ asset('assets/icones/icones dasboard/pagina inicial/Definições/inativo.svg')}}"
                            data-img-hover="{{ asset('assets/icones/icones dasboard/pagina inicial/Definições/ativo.svg')}}"
                            data-page="definicoes">
                            <img src="{{ asset('assets/icones/icones dasboard/pagina inicial/Definições/inativo.svg')}}"
                                alt="" class="w-5 h-5 md:w-6 md:h-6 menu-icon">
                            <span class="text-[#0E3254] font-semibold text-sm md:text-base">Definições</span>
                        </a>
                    </li>

                    <li class="mb-1">
                        <a href="/formularios"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg menu-item hover:bg-gray-100"
                            data-img-default="{{ asset('assets/icones/icones dasboard/pagina inicial/Registro de Atividades/inativo.svg')}}"
                            data-img-hover="{{ asset('assets/icones/icones dasboard/pagina inicial/Registro de Atividades/ativo.svg')}}"
                            data-page="registro">
                            <img src="{{ asset('assets/icones/icones dasboard/pagina inicial/Registro de Atividades/inativo.svg')}}"
                                alt="" class="w-5 h-5 md:w-6 md:h-6 menu-icon">
                            <span class="text-[#0E3254] font-semibold text-sm md:text-base">Formulário</span>
                        </a>
                    </li>

                    <li class="mb-1">
                        <a href="/tabelas"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg menu-item hover:bg-gray-100"
                            data-img-default="{{ asset('assets/icones/icones dasboard/pagina inicial/Registro de Atividades/inativo.svg')}}"
                            data-img-hover="{{ asset('assets/icones/icones dasboard/pagina inicial/Registro de Atividades/ativo.svg')}}"
                            data-page="registro">
                            <img src="{{ asset('assets/icones/icones dasboard/pagina inicial/Registro de Atividades/inativo.svg')}}"
                                alt="" class="w-5 h-5 md:w-6 md:h-6 menu-icon">
                            <span class="text-[#0E3254] font-semibold text-sm md:text-base">Tabelas</span>
                        </a>
                    </li>

                    <li class="mb-1">
                        <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg menu-item hover:bg-gray-100">
                            @csrf
                            <button type="submit"
                            class=" text-[#0E3254] flex items-center gap-2">
                                <i class="text-2xl bx bx-log-out hover:text-orange-400"></i>
                                <span class="font-semibold">Logout</span>
                            </button>
                        </form>
 
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        @yield('content')
    </div>
</body>

</html>