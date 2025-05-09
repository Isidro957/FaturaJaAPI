<div id="notificationPanel"
    class="fixed top-0 right-0 h-full w-80 bg-white border-l border-gray-200 shadow-lg transform translate-x-full transition-transform duration-300 z-50">

    <!-- Header fixo -->
    <div class="flex items-center justify-between px-4 py-4 h-16">
        <h2 class="text-lg font-semibold">Notificações</h2>
        <button onclick="toggleNotifications()" class="text-gray-600">
            <i data-lucide="x"></i>
        </button>
    </div>

    <!-- Conteúdo scrollável -->
    <div class="overflow-y-auto h-[calc(100%-4rem)] p-2 space-y-2">
        <!-- Documento pendente de revisão -->
        <div class="flex items-start gap-3 p-3 hover:bg-gray-100 rounded-lg">
            <i data-lucide="file-warning" class="w-5 h-5 mt-1 text-black"></i>
            <div class="flex-1">
                <p class="text-sm text-gray-800">"Relatório Anual 2024" precisa de revisão.</p>
                <a href="/documentos/456/revisar" class="text-xs font-medium underline">Revisar agora</a>
            </div>
        </div>

        <!-- Documento arquivado -->
        <div class="flex items-start gap-3 p-3 hover:bg-gray-100 rounded-lg">
            <i data-lucide="archive" class="w-5 h-5 mt-1 text-black"></i>
            <div class="flex-1">
                <p class="text-sm text-gray-800">"Contrato Fornecedor X" foi arquivado com sucesso.</p>
                <a href="/documentos/789" class="text-xs font-medium underline">Ver detalhes</a>
            </div>
        </div>

        <!-- Novo documento adicionado -->
        <div class="flex items-start gap-3 p-3 hover:bg-gray-100 rounded-lg">
            <i data-lucide="file-plus" class="w-5 h-5 mt-1 text-black"></i>
            <div class="flex-1">
                <p class="text-sm text-gray-800">Novo documento "Plano Operacional 2025" adicionado.</p>
                <a href="/documentos/321" class="text-xs font-medium underline">Abrir documento</a>
            </div>
        </div>

        <!-- Falta de atualização -->
        <div class="flex items-start gap-3 p-3 hover:bg-gray-100 rounded-lg">
            <i data-lucide="alert-circle" class="w-5 h-5 mt-1 text-black"></i>
            <div class="flex-1">
                <p class="text-sm text-gray-800">"Política de Segurança" está desatualizada.</p>
                <a href="/documentos/159/editar" class="text-xs font-medium underline">Atualizar agora</a>
            </div>
        </div>

        <!-- Documento compartilhado -->
        <div class="flex items-start gap-3 p-3 hover:bg-gray-100 rounded-lg">
            <i data-lucide="send" class="w-5 h-5 mt-1 text-black"></i>
            <div class="flex-1">
                <p class="text-sm text-gray-800">"Manual do Colaborador" foi compartilhado com João.</p>
                <a href="/documentos/753" class="text-xs font-medium underline">Ver documento</a>
            </div>
        </div>
    </div>
</div>