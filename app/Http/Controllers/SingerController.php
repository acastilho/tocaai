<?php

namespace App\Http\Controllers;

use App\Models\Singer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SingerController extends Controller
{
    public function store(Request $request)
{
    try {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $singer = Singer::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . rand(100, 999),
            'pix_key' => $request->pix_key,
            'is_active' => true,
        ]);

        auth()->login($user);

        // Retorno com layout Dark/Coral embutido para teste de sucesso
        return "
        <html>
            <head>
                <script src='https://cdn.tailwindcss.com'></script>
            </head>
            <body class='bg-black text-white flex items-center justify-center min-h-screen p-6'>
                <div class='bg-[#161616] p-10 rounded-[40px] border border-[#222] text-center max-w-sm w-full shadow-2xl'>
                    <h1 class='text-4xl font-black uppercase italic tracking-tighter mb-4'>
                        Toca<span class='text-[#FF4757]'>Aí</span>
                    </h1>
                    <div class='mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-2xl'>
                        <p class='text-green-500 text-[10px] font-black uppercase tracking-widest'>Cadastro Realizado</p>
                    </div>
                    <p class='text-gray-400 text-sm mb-8'>Olá <b>{$user->name}</b>, sua conta foi criada e você já está logado.</p>
                    
                    <a href='/dashboard' class='block w-full bg-[#FF4757] text-white font-black py-4 rounded-2xl uppercase italic hover:brightness-110 transition-all shadow-lg shadow-[#FF4757]/20'>
                        Acessar meu Painel
                    </a>
                    
                    <p class='mt-6 text-[9px] text-gray-600 uppercase font-bold tracking-[0.2em]'>ID de Sessão: " . auth()->id() . "</p>
                </div>
            </body>
        </html>";

    } catch (\Exception $e) {
        return "
        <body class='bg-black text-white flex items-center justify-center min-h-screen'>
            <div class='bg-red-500/10 border border-red-500/30 p-8 rounded-3xl text-center'>
                <h2 class='text-red-500 font-black uppercase'>Erro no Save</h2>
                <p class='text-xs text-gray-500 mt-2'>{$e->getMessage()}</p>
                <a href='javascript:history.back()' class='mt-4 inline-block text-[10px] font-black uppercase text-white underline'>Voltar</a>
            </div>
        </body>";
    }
}
}