<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>TocaAí // Acesso</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans text-gray-100 antialiased bg-black">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/">
                    <h1 class="text-4xl font-black text-yellow-500 italic uppercase tracking-tighter">TocaAí</h1>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-gray-900 shadow-2xl overflow-hidden sm:rounded-3xl border border-gray-800">
                {{ $slot }}
            </div>
            
            <p class="mt-4 text-gray-600 text-xs uppercase tracking-widest font-bold">Área do Músico</p>
        </div>
    </body>
</html>
