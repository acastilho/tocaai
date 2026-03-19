<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TocaAí - Conexão Direta e Pedidos via PIX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        :root { --bg-dark: #0A0A0A; --primary-coral: #FF4757; }
        body { background-color: var(--bg-dark); color: white; font-family: 'Lexend', sans-serif; overflow-x: hidden; }
        .hero-section { min-height: 85vh; display: flex; align-items: center; justify-content: center; text-align: center; }
        .hero-title { font-weight: 900; font-size: clamp(2.5rem, 8vw, 4rem); line-height: 1.1; background: linear-gradient(135deg, #FFF 0%, #AAA 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .btn-coral { background-color: var(--primary-coral); color: white; border-radius: 50px; padding: 15px 35px; font-weight: bold; text-decoration: none; border: none; transition: 0.3s; }
        .btn-coral:hover { background-color: #ff6b81; transform: translateY(-3px); color: white; }
        .text-coral { color: var(--primary-coral); }
        .navbar { border-bottom: 1px solid #222; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark py-3">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3" href="/">Toca<span class="text-coral">Aí</span></a>
        
        <div class="d-flex gap-3">
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('musician.dashboard') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">Meu Painel</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">Login</a>
                @endauth
            @endif
        </div>
    </div>
</nav>

<header class="hero-section">
    <div class="container">
        <div class="badge rounded-pill bg-dark border border-secondary mb-3 px-3 py-2 text-secondary">
            🚀 O palco digital para o seu show
        </div>
        <h1 class="hero-title mb-4">Música ao vivo.<br>Pedidos em tempo real.<br>Pagamento via <span class="text-coral">PIX</span>.</h1>
        <p class="lead text-secondary mb-5 mx-auto" style="max-width: 600px;">
            Aumente seu faturamento e interaja com seu público de forma moderna e instantânea.
        </p>
        
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('musician.register.create') }}" class="btn-coral btn-lg shadow">
                <i class="bi bi-mic-fill me-2"></i>Quero ser Cantor
            </a>
            
            <a href="#como-funciona" class="btn btn-outline-light btn-lg rounded-pill px-4">
                Como funciona?
            </a>
        </div>
    </div>
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
