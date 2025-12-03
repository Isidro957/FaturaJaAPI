<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FacturaJá - Login</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #C9F5D7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }
        .login-card {
            background-color: #FFFFFF;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            text-align: center;
        }
        .login-card h1 {
            color: #3a3a3a;
            margin-bottom: 2rem;
        }
        .login-btn {
            background-color: #C9B6E4;
            color: #fff;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .login-btn:hover {
            background-color: #b494d4;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h1>Bem-vindo à FacturaJá</h1>
        <a href="{{ route('login') }}" class="login-btn">Login com Auth0</a>
    </div>
</body>
</html>
