<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? "TocaAí" }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white antialiased">

    <nav class="bg-gray-900 border-b border-gray-800 px-6 py-4 sticky top-0 z-50">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-6">
                <a href="/" class="text-xl font-black text-yellow-500 italic uppercase tracking-tighter">TocaAí</a>
                
                <div class="flex gap-4 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                    <a href="{{ route("musician.dashboard", ($musician->slug ?? "#")) }}" class="hover:text-yellow-500 transition-colors">Pedidos</a>
                    <a href="{{ route("musician.songs.index", ($musician->slug ?? "#")) }}" class="hover:text-yellow-500 transition-colors">Repertório</a>
                </div>
            </div>

            <form method="POST" action="{{ route("logout") }}">
                @csrf
                <button type="submit" class="text-[10px] font-black uppercase text-gray-500 hover:text-red-500 transition-colors">
                    Sair
                </button>
            </form>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

</body>
</html>
