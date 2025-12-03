<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Login - FaturaJá</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
<div class="card p-4" style="width: 22rem;">
    <h3 class="mb-4">Entrar no FaturaJá</h3>
    <a href="{{ route('auth.redirect', 'google') }}" class="btn btn-danger w-100 mb-2">Login com Google</a>
    <a href="{{ route('auth.redirect', 'github') }}" class="btn btn-dark w-100 mb-2">Login com Github</a>
    <a href="{{ route('auth.redirect', 'linkedin') }}" class="btn btn-primary w-100">Login com LinkedIn</a>
</div>
</body>
</html>
