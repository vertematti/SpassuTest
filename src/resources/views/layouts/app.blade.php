<!-- resources/views/layouts/app.blade.php -->
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Gerson Luis Vertematti Spassu Test</title>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Menu -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column" id="menu-items">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Área Pública</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="/home">Área Restrita</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('config') ? 'active' : '' }}" href="/config">Configurações</a>
                        </li>
                        <!-- Adicione mais itens dinâmicos aqui -->
                    </ul>
                </div>
            </nav>

            <!-- Conteúdo Principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS e script para persistência -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuItems = document.querySelectorAll('#menu-items .nav-link');
            const storedActive = localStorage.getItem('activeMenuItem');

            // Restaurar seleção do localStorage
            if (storedActive) {
                menuItems.forEach(item => {
                    if (item.href === storedActive) {
                        item.classList.add('active');
                    } else {
                        item.classList.remove('active');
                    }
                });
            }

            // Atualizar ao clicar (persiste navegação)
            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    menuItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                    localStorage.setItem('activeMenuItem', this.href);
                });
            });
        });
    </script>
</body>
</html>