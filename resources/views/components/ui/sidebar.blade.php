<div id="sidebar"
    class="sidebar flex flex-col justify-between transition-all duration-300 bg-white border-r w-60 min-h-screen overflow-hidden">
    <div>
        <!-- Logo -->
        <div class="flex items-center justify-center h-16">
            <span id="logoClose" class="hidden text-2xl font-bold text-[#143254]">S</span>
            <span id="logoOpen" class="text-2xl font-bold text-[#143254]">SDOCA</span>
        </div>

        <!-- Menu -->
        <nav class="flex flex-col p-4 space-y-2 text-sm">
            <!-- Itens -->
            <a href="/home" class="menu-item">
                <i data-lucide="home" class="menu-icon"></i>
                <span class="menu-text">Home</span>
            </a>

            <!-- Item com dropdown -->
            <div class="dropdown-container">
                <button onclick="toggleDropdown('doc-submenu')" class="w-full flex items-center justify-between p-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-all">
                    <div class="flex items-center gap-4">
                        <i data-lucide="file-text" class="w-5 h-5 menu-icon"></i>
                        <span class="menu-text">Documentos</span>
                    </div>

                    <i data-lucide="chevron-down" id="icon-doc-submenu" class="w-4 h-4 menu-icon transition-transform duration-300 menu-text"></i>
                </button>

                <!-- Submenu com ícones e indentado -->
                <div id="doc-submenu" class="submenu pl-6 mt-1 space-y-1 hidden">
                    <a href="#" class="menu-item">
                        <i data-lucide="folder" class="w-4 h-4 menu-icon"></i>
                        <span>Departamentos</span>
                    </a>

                    <a href="#" class="menu-item">
                        <i data-lucide="grid" class="w-4 h-4 menu-icon"></i>
                        <span>Áreas</span>
                    </a>

                    <a href="#" class="menu-item">
                        <i data-lucide="briefcase" class="w-4 h-4 menu-icon"></i>
                        <span>Funções</span>
                    </a>

                    <a href="#" class="menu-item">
                        <i data-lucide="layers" class="w-4 h-4 menu-icon"></i>
                        <span>Categorias</span>
                    </a>

                    <a href="#" class="menu-item">
                        <i data-lucide="user" class="w-4 h-4 menu-icon"></i>
                        <span>Usuários</span>
                    </a>
                </div>
            </div>

            <a href="#" class="menu-item">
                <i data-lucide="users" class="menu-icon"></i>
                <span class="menu-text">Usuários</span>
            </a>

            <a href="#" class="menu-item">
                <i data-lucide="settings" class="menu-icon"></i>
                <span class="menu-text">Configurações</span>
            </a>
        </nav>
    </div>
</div>