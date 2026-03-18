<?php
use Illuminate\Support\Facades\Route;
use App\Models\Musician;
use App\Http\Controllers\MusicianSongController;
use App\Http\Controllers\OrderController;

Route::get('/', function () { return view('welcome'); });
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [MusicianSongController::class, 'dashboard'])->name('musician.dashboard');
    
    // Rota com nome inédito para ignorar o lixo do cache do navegador
    Route::get('/dashboard/{slug}/painel-repertorio', [MusicianSongController::class, 'index'])->name('musician.songs.index');
    Route::post('/dashboard/{slug}/painel-repertorio', [MusicianSongController::class, 'store'])->name('musician.songs.store');
    Route::delete('/dashboard/{slug}/painel-repertorio/{id}', [MusicianSongController::class, 'destroy'])->name('musician.songs.destroy');
    
    Route::post('/dashboard/{slug}/pix', [MusicianSongController::class, 'updatePix'])->name('musician.pix.update');
});

Route::get('/{slug}', function ($slug) {
    $musician = Musician::where('slug', $slug)->firstOrFail();
    return view('musician.show', compact('musician'));
})->name('musician.show');
