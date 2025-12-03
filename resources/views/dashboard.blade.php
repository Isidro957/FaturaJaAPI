<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FaturaJá</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #C9F5D7;
            color: #3a3a3a;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background-color: #C9B6E4;
            padding: 1rem 2rem;
            color: #fff;
        }

        main {
            flex: 1;
            padding: 2rem;
        }

        .card {
            background-color: #fff;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            margin-bottom: 2rem;
        }

        .logout-btn {
            background-color: #fff;
            color: #6B4FA3;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background-color: #f1e8ff;
        }

        .roles-list li {
            display: inline-block;
            background-color: #C9B6E4;
            color: #fff;
            padding: 0.35rem 0.8rem;
            margin: 0.2rem;
            border-radius: 6px;
            font-weight: 600;
        }

        .area-link {
            display: inline-block;
            margin: 0.3rem;
            padding: 0.6rem 1.2rem;
            background-color: #C9B6E4;
            color: #fff;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }

        .area-link:hover {
            background-color: #b494d4;
        }

        .avatar {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 1rem;
        }

        .user-info {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header class="d-flex justify-content-between align-items-center">
        <h1>FaturaJá Dashboard</h1>
        <a href="{{ route('logout') }}" class="logout-btn">Logout</a>
    </header>

    <!-- Conteúdo -->
    <main class="container">

        <!-- Card Perfil -->
        <div class="card">
            <div class="user-info">
                @if(isset($user['picture']))
                    <img src="{{ $user['picture'] }}" class="avatar" alt="Foto do usuário">
                @endif

                <div>
                    <h2>{{ $user['name'] ?? $user['email'] }}</h2>
                    <p>Email: <strong>{{ $user['email'] }}</strong></p>
                </div>
            </div>
        </div>

        <!-- Card Roles -->
        <div class="card">
            <h3>Suas Roles</h3>

            @php
                $roles = session('auth0_roles') ?? [];
            @endphp

            @if(count($roles) > 0)
                <ul class="roles-list">
                    @foreach($roles as $r)
                        <li>{{ $r }}</li>
                    @endforeach
                </ul>
            @else
                <p>Você não possui roles atribuídas.</p>
            @endif
        </div>

        <!-- Áreas baseadas em roles -->
        <div class="card">
            <h3>Áreas do Sistema</h3>

            @if(in_array('Admin', $roles))
                <a href="/admin-area" class="area-link">Área Administrativa</a>
            @endif

            @if(in_array('Empresa', $roles))
                <a href="/empresa-area" class="area-link">Área da Empresa</a>
            @endif

            @if(in_array('Cliente', $roles))
                <a href="/cliente-area" class="area-link">Área do Cliente</a>
            @endif

            @if(count($roles) === 0)
                <p>Não há áreas disponíveis para você.</p>
            @endif
        </div>

    </main>

</body>
</html>
