<?php
namespace App\Http\Controllers;

use App\Models\Musician;
use App\Models\Song;
use App\Models\SongRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MusicianSongController extends Controller
{
    public function dashboard() {
        $musician = Musician::where("user_id", Auth::id())->first();
        if (!$musician) return redirect("/");
        
        $orders = SongRequest::whereHas("song", function($q) use ($musician) {
            $q->where("musician_id", $musician->id);
        })->with("song")->latest()->get();

        return view("dashboard", compact("musician", "orders"));
    }

    public function index($slug) {
        $musician = Musician::where("slug", $slug)->firstOrFail();
        $songs = $musician->songs()->latest()->get();
        return view("musician.songs.index", compact("musician", "songs"));
    }

    public function store(Request $request, $slug) {
        $musician = Musician::where("slug", $slug)->firstOrFail();
        
        // Forçando o salvamento direto para evitar bloqueios do Laravel
        $song = new Song();
        $song->title = $request->title;
        $song->artist_original = $request->artist_original;
        $musician->songs()->save($song);
        
        return back()->with("success", "Música adicionada!");
    }

    public function destroy($slug, $id) {
        Song::destroy($id);
        return back();
    }

    public function updatePix(Request $request, $slug) {
        $musician = Musician::where("slug", $slug)->firstOrFail();
        
        // A MÁGICA ESTÁ AQUI: Salvamento direto da chave Pix
        $musician->pix_key = $request->pix_key;
        $musician->save();
        
        return back()->with("success", "Pix atualizado!");
    }
}
