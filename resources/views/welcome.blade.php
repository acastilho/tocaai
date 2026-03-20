<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TocaAí // O Palco Digital do seu Show</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
        body { background-color: #000; color: #fff; font-family: 'Inter', sans-serif; overflow-x: hidden; }
        .text-coral { color: #FF4757; }
        .bg-coral { background-color: #FF4757; }
        .hero-gradient {
            background: linear-gradient(135deg, #FFF 30%, #555 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </div>
    </style>
</head>
<body class="selection:bg-coral selection:text-white">

    <nav class="border-b border-[#111] py-6 backdrop-blur-md bg-black/50 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <a href="/" class="text-3xl font-black uppercase italic tracking-tighter">
                Toca<span class="text-coral">Aí</span>
            </a>
            
            <div class="flex items-center gap-6">
                <a href="{{ route('how.it.works') }}" class="hidden md:block text-[10px] font-black uppercase tracking-widest text-gray-500 hover:text-white transition-all">
                    Como funciona
                </a>
                
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('musician.dashboard') }}" class="bg-[#161616] border border-[#222] text-white px-6 py-2.5 rounded-full text-[10px] font-black uppercase tracking-widest hover:border-coral transition-all">
                            Meu Painel
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-widest text-white hover:text-coral transition-all">
                            Login
                        </a>
                        <a href="/register-singer" class="bg-coral text-white px-6 py-2.5 rounded-full text-[10px] font-black uppercase tracking-widest hover:brightness-110 shadow-lg shadow-coral/20 transition-all">
                            Cadastrar
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <header class="relative min-h-[90vh] flex items-center justify-center overflow-hidden pt-20">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-coral/10 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-4xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-[#222] bg-[#111] mb-8 animate-bounce">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-coral opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-coral"></span>
                </span>
                <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">O palco digital para o seu show</span>
            </div>

            <h1 class="hero-gradient text-5xl md:text-8xl font-black uppercase italic tracking-tighter leading-[0.9] mb-8">
                Música ao vivo.<br>
                Pedidos em <span class="text-coral">Real-Time.</span>
            </h1>

            <p class="text-gray-500 text-lg md:text-xl max-w-2xl mx-auto mb-12 font-medium">
                Aumente seu faturamento e interaja com seu público de forma moderna. Receba pedidos e pagamentos via <span class="text-white font-bold">PIX</span> instantaneamente.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/register-singer" class="w-full sm:w-auto bg-coral text-white px-10 py-5 rounded-2xl text-sm font-black uppercase italic hover:scale-105 active:scale-95 transition-all shadow-2xl shadow-coral/30">
                    <i class="bi bi-mic-fill mr-2"></i> Quero Cantar
                </a>
                
                <a href="{{ route('how.it.works') }}" class="w-full sm:w-auto bg-[#161616] border border-[#222] text-white px-10 py-5 rounded-2xl text-sm font-black uppercase italic hover:bg-white hover:text-black transition-all">
                    Como funciona?
                </a>
            </div>
        </div>
    </header>

    <footer class="py-20 border-t border-[#111] text-center">
        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-700">
            TocaAí © 2026 // Desenvolvido por André Castilho
        </p>
    </footer>

</body>
</html>