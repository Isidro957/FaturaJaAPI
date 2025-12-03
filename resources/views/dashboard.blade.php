<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FaturaJá</title>
    <!-- Bootstrap CDN -->
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
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        a.logout-btn {
            display: inline-block;
            margin-top: 1rem;
            background-color: #C9B6E4;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        a.logout-btn:hover {
            background-color: #b494d4;
        }
        .roles-list li {
            display: inline-block;
            background-color: #C9B6E4;
            color: #fff;
            padding: 0.3rem 0.7rem;
            margin: 0.2rem;
            border-radius: 5px;
            font-weight: bold;
        }
        .area-link {
            display: inline-block;
            margin: 0.3rem 0.5rem 0.3rem 0;
            padding: 0.5rem 1rem;
            background-color: #C9B6E4;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .area-link:hover {
            background-color: #b494d4;
        }
        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-right: 1rem;
        }
        .user-info {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <header class="d-flex justify-content-between align-items-center">
        <h1>FaturaJá Dashboard</h1>
        <a href="{{ route('logout') }}" class="logout-btn">Logout</a>
    </header>

    <main class="container">
        <!-- Perfil do usuário -->
        <div class="card">
            <div class="user-info">
                @if(!empty($user['picture']))
                    <img src="{{ $user['picture'] }}" alt="Avatar" class="avatar">
                @endif
                <div>
                    <h2>{{ $user['name'] ?? $user['email'] }}</h2>
                    <p>Email: {{ $user['email'] ?? 'Não disponível' }}</p>
                </div>
            </div>
        </div>

        <!-- Roles -->
        <div class="card">
            <h3>Suas Roles</h3>
            @if(session('auth0_roles') && count(session('auth0_roles')) > 0)
                <ul class="roles-list">
                    @foreach(session('auth0_roles') as $role)
                        <li>{{ $role }}</li>
                    @endforeach
                </ul>
            @else
                <p>Você não possui roles atribuídas.</p>
            @endif
        </div>

        <!-- Áreas do dashboard baseadas em roles -->
        <div class="card">
            <h3>Áreas do Dashboard</h3>
@php
    $roles = session('auth0_roles') ?? [];
@endphp


<h3>Suas Roles</h3>

@if(count($roles) > 0)
    <ul>
        @foreach($roles as $role)
            <li>{{ $role }}</li>
        @endforeach
    </ul>
@else
    <p>Você não possui roles atribuídas.</p>
@endif


            @if(in_array('Admin', $roles))
                <a href="/admin-area" class="area-link">Área Administrativa</a>
            @endif

            @if(in_array('Empresa', $roles))
                <a href="/empresa-area" class="area-link">Área da Empresa</a>
            @endif

            @if(in_array('Cliente', $roles))
                <a href="/cliente-area" class="area-link">Área do Cliente</a>
            @endif

            @if(empty($user['roles']))
    Você não possui roles atribuídas.
@endif

        </div>
        <!-- Debug: Exibir todos os dados da sessão
        <pre>
            {{ print_r(session()->all(), true) }}
        </pre>
        -->

    </main>
</body>
</html>
