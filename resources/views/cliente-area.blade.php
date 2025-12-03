<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Cliente - FaturaJá</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #C9F5D7; color: #3a3a3a; min-height: 100vh; display: flex; flex-direction: column; }
        header { background-color: #C9B6E4; padding: 1rem 2rem; color: #fff; }
        main { flex: 1; padding: 2rem; }
        .card { background-color: #fff; border-radius: 15px; padding: 1.5rem; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        a.logout-btn { display: inline-block; margin-top: 1rem; background-color: #C9B6E4; color: #fff; padding: 0.5rem 1rem; border-radius: 8px; text-decoration: none; transition: background-color 0.3s; }
        a.logout-btn:hover { background-color: #b494d4; }
    </style>
</head>
<body>
    <header class="d-flex justify-content-between align-items-center">
        <h1>Área do Cliente</h1>
        <a href="{{ route('logout') }}" class="logout-btn">Logout</a>
    </header>

    <main class="container">
        <div class="card">
            <h2>Bem-vindo, {{ $user['name'] ?? $user['email'] }}!</h2>
            <p>Funções atribuídas: {{ implode(', ', session('auth0_roles', [])) }}</p>
            <pre>{{ print_r($user, true) }}</pre>
        </div>
    </main>
</body>
</html>
