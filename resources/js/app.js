import '../css/app.css';

document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".menu-item");
    const sidebar = document.getElementById("sidebar");
    const sidebarToggleOpen = document.getElementById("sidebarToggleOpen");
    const sidebarToggleClose = document.getElementById("sidebarToggleClose");

    document.getElementById("menu-btn-open").addEventListener("click", function () {
        document.getElementById("sidebar").classList.toggle("hidden");
    });
    document.getElementById("menu-btn-close").addEventListener("click", function () {
        document.getElementById("sidebar").classList.toggle("hidden");
    });

    /* Abrir e fechar a sidebar em mobile
        sidebarToggleOpen.addEventListener("click", function () {
            sidebar.classList.toggle("-translate-x-full");
        });
        sidebarToggleClose.addEventListener("click", function () {
            sidebar.classList.toggle("-translate-x-full");
        });

        // Fechar sidebar ao clicar fora em mobile
        document.addEventListener("click", function (event) {
            if (window.innerWidth < 768 && !sidebar.contains(event.target) && event.target !== sidebarToggleOpen) {
                sidebar.classList.add("-translate-x-full");
            }
        });
    */


    function setActiveMenu(selectedItem) {
        menuItems.forEach(item => {
            item.classList.remove("bg-gray-100", "active");
            item.querySelector(".menu-icon").src = item.getAttribute("data-img-default");
        });

        selectedItem.classList.add("bg-gray-100", "active");
        selectedItem.querySelector(".menu-icon").src = selectedItem.getAttribute("data-img-hover");

        localStorage.setItem("activePage", selectedItem.getAttribute("data-page"));
    }

    // Evento para alternar ao clicar e navegar corretamente
    menuItems.forEach(item => {
        item.addEventListener("click", function () {
            setActiveMenu(this); // Ativa o item do menu normalmente
        });

        // Adiciona efeito de hover normalmente
        item.addEventListener("mouseover", function () {
            if (!this.classList.contains("active")) {
                this.querySelector(".menu-icon").src = this.getAttribute("data-img-hover");
            }
        });

        item.addEventListener("mouseout", function () {
            if (!this.classList.contains("active")) {
                this.querySelector(".menu-icon").src = this.getAttribute("data-img-default");
            }
        });
    });

    // Restaurar página ativa do localStorage
    const savedPage = localStorage.getItem("activePage");
    if (savedPage) {
        const activeItem = document.querySelector(`.menu-item[data-page="${savedPage}"]`);
        if (activeItem) {
            setActiveMenu(activeItem);
        }
    }

    /* Ajustar sidebar no resize
    window.addEventListener("resize", function () {
        if (window.innerWidth >= 768) {
            sidebar.classList.remove("-translate-x-full");
        } else {
            sidebar.classList.add("-translate-x-full");
        }
    });*/
});

document.getElementById('foto').addEventListener('change', function (event) {
    var file = event.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

