<?php

namespace App\Http\Controllers;

use App\Models\Musician;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MusicianRegistrationController extends Controller
{
    public function create()
    {
        return view('musician.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'name' => 'required|string|max:255',
            'pix_key' => 'required|string|max:255',
        ]);

        // 1. Cria o Usuário para o Login
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 2. Cria o perfil do Músico vinculado a esse usuário
        $musician = Musician::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'pix_key' => $request->pix_key,
            'slug' => Str::slug($request->name) . '-' . rand(1000, 9999),
            'is_active' => true,
        ]);

        // 3. Loga o usuário automaticamente
        Auth::login($user);

        // 4. Redireciona para o Dashboard
        return redirect()->route('musician.dashboard')
                         ->with('success', 'Bem-vindo ao TocaAí!');
    }
}
