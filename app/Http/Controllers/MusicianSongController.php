<?php

namespace App\Http\Controllers;

use App\Models\Musician;
use App\Models\Song;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MusicianSongController extends Controller
{
    /**
     * Dashboard Principal: Exibe os pedidos recebidos.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $musician = Musician::where('user_id', $user->id)->first();

        if (!$musician) {
            return redirect()->route('home')->with('error', 'Perfil de músico não encontrado.');
        }

        // Pegamos todos os pedidos vinculados a este músico para testar a exibição
        $orders = Order::where('musician_id', $musician->id)
                       ->with('song')
                       ->latest()
                       ->get();

        return view('musician.dashboard', compact('musician', 'orders'));
    }

    /**
     * Lista de Repertório: Exibe as músicas que o cantor toca.
     */
    public function index($slug)
    {
        $musician = Musician::where('slug', $slug)->firstOrFail();
        
        // Segurança: só o dono do perfil acessa o painel de edição
        if (Auth::id() !== $musician->user_id) {
            abort(403);
        }

        $songs = $musician->songs()->latest()->get();

        return view('musician.songs.index', compact('musician', 'songs'));
    }

    /**
     * Adicionar Música: Salva nova música no repertório.
     */
    public function store(Request $request, $slug)
    {
        $musician = Musician::where('slug', $slug)->firstOrFail();

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'nullable|string|max:255',
        ]);

        $musician->songs()->create($data);

        return back()->with('success', 'Música adicionada com sucesso!');
    }

    /**
     * Remover Música: Exclui do repertório.
     */
    public function destroy($slug, $id)
    {
        $song = Song::where('id', $id)->firstOrFail();
        $song->delete();

        return back()->with('success', 'Música removida do repertório.');
    }
}
