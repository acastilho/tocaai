<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Como Funciona // TocaAí</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
        body { background-color: #000; color: #fff; font-family: 'Inter', sans-serif; overflow-x: hidden; }
        .text-coral { color: #FF4757; }
        .bg-coral { background-color: #FF4757; }
        .card-step { 
            background: linear-gradient(145deg, #111111, #080808);
            border: 1px solid #222;
            transition: all 0.3s ease;
        }
        .card-step:hover {
            border-color: #FF4757;
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(255, 71, 87, 0.1);
        }
        .glow-coral { text-shadow: 0 0 15px rgba(255, 71, 87, 0.5); }
    </style>
</head>
<body class="py-12 px-6">

    <div class="max-w-6xl mx-auto">
        <header class="mb-16 text-center">
            <a href="/" class="text-3xl font-black uppercase italic tracking-tighter hover:opacity-80 transition-opacity text-white no-underline">
                Toca<span class="text-coral">Aí</span>
            </a>
            <h1 class="text-5xl md:text-7xl font-black uppercase italic mt-8 tracking-tighter leading-none">
                Como <span class="text-coral">Funciona?</span>
            </h1>
            <p class="text-gray-500 mt-6 uppercase text-[10px] font-black tracking-[0.4em]">O fluxo completo do seu show digital</p>
        </header>

        <div class="mb-20">
            <div class="flex items-center gap-4 mb-10">
                <div class="h-px bg-gray-800 flex-1"></div>
                <h2 class="text-xs font-black uppercase tracking-[0.3em] text-coral italic">Área do Cantor</h2>
                <div class="h-px bg-gray-800 flex-1"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="card-step p-8 rounded-[32px]">
                    <span class="text-coral font-black italic text-4xl mb-4 block glow-coral">01.</span>
                    <h3 class="text-white font-black uppercase italic text-lg mb-2">Setup</h3>
                    <p class="text-gray-500 text-sm">Cadastre seu perfil e repertório em minutos.</p>
                </div>
                <div class="card-step p-8 rounded-[32px]">
                    <span class="text-coral font-black italic text-4xl mb-4 block glow-coral">02.</span>
                    <h3 class="text-white font-black uppercase italic text-lg mb-2">QR Code</h3>
                    <p class="text-gray-500 text-sm">Exiba seu código para o público escanear.</p>
                </div>
                <div class="card-step p-8 rounded-[32px]">
                    <span class="text-coral font-black italic text-4xl mb-4 block glow-coral">03.</span>
                    <h3 class="text-white font-black uppercase italic text-lg mb-2">Faturamento</h3>
                    <p class="text-gray-500 text-sm">Receba pedidos e PIX direto no seu painel.</p>
                </div>
                <div class="card-step p-8 rounded-[32px] border-coral/50 border-2 shadow-[0_0_20px_rgba(255,71,87,0.1)]">
                    <span class="text-coral font-black italic text-4xl mb-4 block glow-coral">04.</span>
                    <h3 class="text-white font-black uppercase italic text-lg mb-2">Voz AI</h3>
                    <p class="text-gray-500 text-sm">O sistema agradece o fã e anuncia a música nas caixas.</p>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto mb-20">
            <div class="bg-[#111] border border-[#222] p-8 md:p-12 rounded-[40px] relative overflow-hidden group">
                <div class="grid md:grid-cols-3 gap-10 relative z-10">
                    <div class="text-center md:text-left">
                        <i class="bi bi-qr-code-scan text-2xl text-coral mb-4 block"></i>
                        <h4 class="font-black uppercase italic text-white mb-2">01. Escaneie</h4>
                        <p class="text-gray-500 text-xs">Aponte a câmera para o QR Code.</p>
                    </div>
                    <div class="text-center md:text-left">
                        <i class="bi bi-currency-dollar text-2xl text-coral mb-4 block"></i>
                        <h4 class="font-black uppercase italic text-white mb-2">02. Escolha</h4>
                        <p class="text-gray-500 text-xs">Selecione a música e faça o PIX.</p>
                    </div>
                    <div class="text-center md:text-left">
                        <i class="bi bi-music-note-beamed text-2xl text-coral mb-4 block"></i>
                        <h4 class="font-black uppercase italic text-white mb-2">03. Curta</h4>
                        <p class="text-gray-500 text-xs">Ouça sua música ao vivo no show.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="/register-singer" class="inline-flex items-center gap-3 bg-coral text-white px-12 py-6 rounded-full text-sm font-black uppercase italic hover:scale-105 active:scale-95 transition-all shadow-[0_15px_30px_rgba(255,71,87,0.3)] no-underline">
                Começar meu show agora
                <i class="bi bi-arrow-right"></i>
            </a>
            <p class="text-gray-600 text-[9px] mt-6 font-bold uppercase tracking-widest">Setup rápido. Sem mensalidade.</p>
        </div>
    </div>

</body>
</html>