<?php

namespace App\Http\Controllers;

use App\Models\Musician;
use App\Models\Singer;
use App\Models\Song;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MusicianSongController extends Controller
{
    /**
     * Dashboard Principal: Exibe os pedidos recebidos.
     */
    public function dashboard()
    {
        $user = auth()->user();

        // Busca o perfil unificado (Tenta Musician, se não achar, tenta Singer)
        $profile = Musician::where('user_id', $user->id)->first() 
                   ?? Singer::where('user_id', $user->id)->first();

        // Se não existir perfil, redireciona ou avisa, em vez de dar erro 500
        if (!$profile) {
            return redirect()->route('home')->with('error', 'Perfil não encontrado para este usuário.');
        }

        // Busca pedidos vinculados ao ID do perfil
        // Importante: certifique-se que na tabela 'orders' a coluna é 'musician_id'
        $orders = Order::where('musician_id', $profile->id)
                       ->where('status', 'pending')
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('musician.dashboard', [
            'musician' => $profile, 
            'orders' => $orders
        ]);
    }

    /**
     * Concluir Pedido: Atualiza status e limpa da fila.
     */
    public function completeOrder($id)
    {
        try {
            $order = Order::findOrFail($id);
            $user_id = auth()->id();

            // Validação de segurança: o pedido pertence ao usuário logado?
            $profile = Musician::where('user_id', $user_id)->first() 
                       ?? Singer::where('user_id', $user_id)->first();

            if (!$profile || $order->musician_id != $profile->id) {
                return back()->with('error', 'Ação não autorizada.');
            }

            $order->update(['status' => 'completed']);

            return back()->with('success', 'Pedido concluído!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao concluir: ' . $e->getMessage());
        }
    }

    /**
     * Lista de Repertório: Exibe as músicas.
     */
    public function index($slug)
    {
        // Busca o perfil pelo slug usando o padrão unificado
        $musician = Musician::where('slug', $slug)->first() 
                    ?? Singer::where('slug', $slug)->firstOrFail();

        // Carrega as músicas (Relacionamento belongsTo/hasMany deve estar configurado no Model)
        $songs = $musician->songs()->orderBy('title')->get(); 

        return view('musician.songs.index', compact('musician', 'songs'));
    }

    /**
     * Adicionar Música: Salva nova música no repertório.
     */
    public function store(Request $request, $slug)
    {
        $request->validate(['title' => 'required|string|max:255']);

        // Localiza o perfil dono do slug
        $profile = Musician::where('slug', $slug)->first() 
                   ?? Singer::where('slug', $slug)->firstOrFail();

        // Sincronização de segurança (Sua "Gambiarra de Sobrevivência" melhorada)
        // Se o perfil for Singer, garantimos que ele existe na tabela 'musicians' para evitar erro de FK
        if ($profile instanceof Singer) {
            DB::table('musicians')->updateOrInsert(
                ['id' => $profile->id],
                [
                    'user_id' => $profile->user_id,
                    'name' => $profile->name,
                    'slug' => $profile->slug,
                    'is_active' => true,
                    'updated_at' => now(),
                ]
            );
        }

        // Criação da música vinculada ao ID do perfil encontrado
        Song::create([
            'musician_id' => $profile->id,
            'title' => $request->title,
            'is_active' => true,
        ]);

        return back()->with('success', 'Música adicionada com sucesso!');
    }

    /**
     * Remover Música: Deleta do repertório.
     */
    public function destroy($slug, $id)
    {
        // Busca a música e verifica se o ID dela existe
        $song = Song::findOrFail($id);
        
        // Opcional: Validar se a música pertence ao músico logado antes de deletar
        $song->delete();

        return back()->with('success', 'Música removida!');
    }
}