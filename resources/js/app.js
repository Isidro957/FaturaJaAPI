import '../css/app.css';

// Variável de estado para controlar se a sidebar está colapsada
let sidebarCollapsed = false;

window.toggleDropdown = function (id) {
    const submenu = document.getElementById(id);
    const icon = document.getElementById("icon-" + id);
    const sidebar = document.getElementById('sidebar');

    // Se a sidebar estiver colapsada, não mostra o submenu
    if (sidebarCollapsed) {
        return;
    }

    submenu.classList.toggle("hidden");
    icon.classList.toggle("rotate-180");
}

function initProfileDropdown(btnId = 'btn-perfil', menuId = 'menu-perfil') {
    const btn = document.getElementById(btnId);
    const menu = document.getElementById(menuId);

    if (!btn || !menu) return;

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });

    // Carrega os ícones (Lucide)
    lucide?.createIcons();
}

// Inicializar quando a página estiver pronta
window.addEventListener('DOMContentLoaded', () => {
    initProfileDropdown();
});

window.toggleNotifications = function () {
    const panel = document.getElementById('notificationPanel');
    panel.classList.toggle('translate-x-full');
    panel.classList.toggle('translate-x-0');
}

window.toggleSidebar = function () {
    const sidebar = document.getElementById('sidebar');
    const menuTexts = document.querySelectorAll('.menu-text');
    const logoOpen = document.getElementById('logoOpen');
    const logoClose = document.getElementById('logoClose');
    const submenus = document.querySelectorAll('.submenu');

    sidebar.classList.toggle('w-60');
    sidebar.classList.toggle('w-20');
    sidebar.classList.toggle('collapsed');

    // Alterna o estado de colapsado da sidebar
    sidebarCollapsed = !sidebarCollapsed;

    // Alterna visibilidade dos textos dos menus
    menuTexts.forEach(text => {
        text.classList.toggle('hidden');
    });

    // Esconde todos os submenus quando a sidebar for colapsada
    if (sidebarCollapsed) {
        submenus.forEach(submenu => {
            submenu.classList.add('hidden');
        });
    }

    // Alterna entre "SDOCA" e "S"
    logoOpen.classList.toggle('hidden');
    logoClose.classList.toggle('hidden');
}

// Fecha dropdown ao clicar fora
document.addEventListener('click', function (e) {
    document.querySelectorAll('.dropdown').forEach(dropdown => {
        if (!dropdown.contains(e.target)) {
            dropdown.classList.remove('open');
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("hs-table-search");
    const tableRows = document.querySelectorAll("tbody tr");

    // Cria a linha da mensagem "sem resultados"
    const tbody = document.querySelector("tbody");
    const noResultsRow = document.createElement("tr");
    noResultsRow.innerHTML = `
        <td colspan="4">
            <div class="flex flex-col items-center justify-center py-6 text-sm text-gray-500">
            <i data-lucide="search-x" class="w-6 h-6 text-gray-400 mb-2"></i>
            Nenhum resultado encontrado
            </div>
        </td>
    `;

    noResultsRow.style.display = "none";
    tbody.appendChild(noResultsRow);

    searchInput.addEventListener("input", function () {
        const filtro = searchInput.value.toLowerCase();
        let resultados = 0;

        tableRows.forEach((row) => {
            const textoLinha = row.innerText.toLowerCase();
            const match = textoLinha.includes(filtro);
            row.style.display = match ? "" : "none";
            if (match) resultados++;
        });

        // Se nenhum resultado, mostra a linha de aviso
        noResultsRow.style.display = resultados === 0 ? "" : "none";
    });
});

window.addEventListener('DOMContentLoaded', () => {

});
// Ativa os ícones Lucide
lucide.createIcons();