<?php

namespace App\Http\Controllers;

use App\Models\Musician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MusicianController extends Controller
{
public function show($slug)
{
    // Busca o perfil (seja Singer ou Musician)
    $profile = \App\Models\Musician::where('slug', $slug)->first() 
               ?? \App\Models\Singer::where('slug', $slug)->first();

    if (!$profile) abort(404);

    // Certifique-se de que está passando o 'profile' como 'musician' para o Blade
    return view('musician.show', ['musician' => $profile]);
}

   public function store(Request $request)
{
    // 1. Gera o slug na hora (já que não tem no formulário)
    $request->merge([
        'slug' => \Illuminate\Support\Str::slug($request->name)
    ]);

    try {
        // 2. Validação (incluindo o que você realmente pede no form)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:musicians,slug',
            'pix_key' => 'required|string',
        ]);

        // 3. Salva (Garante que pix_key esteja no $fillable do Model)
        $musician = \App\Models\Musician::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'pix_key' => $validated['pix_key'],
            'is_active' => true,
        ]);

        // 4. Sucesso! Redireciona para o perfil criado
        return redirect()->route('musician.show', $musician->slug);

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Se der erro de validação (ex: nome já existe), mostra aqui
        return response()->json($e->errors(), 422);
    }
}
}
