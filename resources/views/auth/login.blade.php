<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login // TocaAí</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-black text-white flex items-center justify-center min-h-screen p-6">
    
    <div class="bg-[#111] p-10 rounded-[48px] border border-[#222] w-full max-w-md shadow-[0_20px_50px_rgba(0,0,0,0.7)]">
        
        <div class="text-center mb-10">
            <h1 class="text-5xl font-black uppercase italic tracking-tighter text-white">
                Toca<span class="text-[#FF4757]">Aí</span>
            </h1>
            <div class="inline-block mt-4 px-4 py-1 rounded-full border border-[#222] text-gray-500 text-[10px] font-bold uppercase tracking-[0.2em]">
                Painel do Artista
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-2xl">
                <ul class="list-none">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500 text-[10px] font-black uppercase tracking-widest text-center">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-5">
                <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 ml-5 tracking-widest">E-mail</label>
                <div class="relative">
                    <i class="bi bi-envelope absolute left-5 top-1/2 -translate-y-1/2 text-gray-700"></i>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-black border-2 border-[#222] rounded-2xl pl-12 pr-6 py-4 text-white focus:border-[#FF4757] outline-none transition-all placeholder-gray-800"
                           placeholder="seu@email.com">
                </div>
            </div>

            <div class="mb-8">
                <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 ml-5 tracking-widest">Senha</label>
                <div class="relative">
                    <i class="bi bi-lock absolute left-5 top-1/2 -translate-y-1/2 text-gray-700"></i>
                    <input type="password" name="password" required
                           class="w-full bg-black border-2 border-[#222] rounded-2xl pl-12 pr-6 py-4 text-white focus:border-[#FF4757] outline-none transition-all"
                           placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center justify-between mb-10 px-2">
                <label class="flex items-center cursor-pointer group">
                    <input type="checkbox" name="remember" class="w-5 h-5 rounded border-[#333] bg-black text-[#FF4757] focus:ring-[#FF4757] transition-all">
                    <span class="ml-3 text-[10px] font-bold text-gray-500 uppercase tracking-widest group-hover:text-gray-300 transition-colors">Lembrar de mim</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-[#FF4757] text-white font-black py-5 rounded-2xl uppercase italic text-lg hover:brightness-110 active:scale-[0.98] transition-all shadow-xl shadow-[#FF4757]/20">
                Entrar no Palco
            </button>

            @if (Route::has('password.request'))
                <div class="mt-8 text-center">
                    <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-gray-700 uppercase tracking-widest hover:text-white transition-all">
                        Esqueceu a senha?
                    </a>
                </div>
            @endif
        </form>
    </div>

</body>
</html>