<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login // TocaAí</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white flex items-center justify-center min-h-screen p-6">
    <div class="bg-gray-900 p-8 rounded-[40px] border border-gray-800 w-full max-w-md shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-yellow-500 uppercase italic tracking-tighter">TocaAí</h1>
            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mt-2">Painel do Artista</p>
        </div>

        <form method="POST" action="/login">
            @csrf
            <div class="mb-4">
                <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 ml-4">E-mail</label>
                <input type="email" name="email" required autofocus
                       class="w-full bg-black border-2 border-gray-800 rounded-2xl px-6 py-4 text-white focus:border-yellow-500 outline-none transition-all">
            </div>

            <div class="mb-8">
                <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 ml-4">Senha</label>
                <input type="password" name="password" required
                       class="w-full bg-black border-2 border-gray-800 rounded-2xl px-6 py-4 text-white focus:border-yellow-500 outline-none transition-all">
            </div>

            <button type="submit" class="w-full bg-yellow-500 text-black font-black py-5 rounded-2xl uppercase italic hover:scale-[1.02] active:scale-95 transition-all shadow-lg shadow-yellow-500/20">
                Entrar no Palco
            </button>
        </form>
    </div>
</body>
</html>
