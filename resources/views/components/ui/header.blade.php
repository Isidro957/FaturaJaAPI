<header class="flex items-center justify-between h-16 gap-2 px-6 bg-white border-b">
    <div class="flex items-center gap-4">
        <x-buttons.action id="toggleBtn" onclick="toggleSidebar()">
            <i id="toggleIcon" data-lucide="menu"></i>
        </x-buttons.action>
    </div>

    <div class="flex items-center gap-2">
        <x-buttons.action onclick="toggleNotifications()" class="border-[10px]">
            <i data-lucide="bell" class="w-6 h-6 text-gray-600"></i>
        </x-buttons.action>

        <div class="relative">
            <!-- Botão de perfil -->
            <button id="btn-perfil"
                class="w-9 h-9 rounded-full overflow-hidden bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-300">
                <span>M</span>
            </button>

            <!-- Menu de opções -->
            <div id="menu-perfil" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg z-50 border border-gray-100">
                <ul class="text-sm text-gray-600">
                    <li>
                        <a href="/perfil" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-50">
                            <i data-lucide="user" class="w-4 h-4"></i> Perfil
                        </a>
                    </li>
                    <li>
                        <a href="/configuracoes" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-50">
                            <i data-lucide="settings" class="w-4 h-4"></i> Configurações
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 hover:bg-gray-50 text-left">
                                <i data-lucide="log-out" class="w-4 h-4"></i> Sair
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>