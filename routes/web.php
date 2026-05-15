<?php

use Illuminate\Support\Facades\Route;
use App\Models\Musician;
use App\Http\Controllers\MusicianSongController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MusicianController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PushSubscriptionController;

// --- INFRA E DB ---
Route::get('/prepare-db', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return "Banco de dados preparado com sucesso!";
    } catch (\Exception $e) {
        return "Erro ao preparar banco: " . $e->getMessage();
    }
});

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/como-funciona', [HomeController::class, 'howItWorks'])->name('how.it.works');

Route::get('/dashboard/{slug}/repertorio/importar', [MusicianSongController::class, 'importView'])->name('musician.songs.import');
Route::post('/dashboard/{slug}/repertorio/importar', [MusicianSongController::class, 'importStore'])->name('musician.songs.import.store');

// Rota de GET para abrir o formulário
Route::get('/register-singer', function() { 
    return view('singer.register'); 
})->name('singer.register.create');

// Rota de POST para processar o cadastro (A QUE ESTÁ DANDO ERRO)
Route::post('/novo-singer', [App\Http\Controllers\SingerController::class, 'store'])->name('singer.store');

// ROTA DE TESTE RÁPIDO: Se o cadastro falhar, use esta via cURL para ver o erro real
Route::post('/debug-post', function(Request $request) {
    try {
        $m = Musician::create($request->all());
        return response()->json(['status' => 'success', 'data' => $m]);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
});

// --- PEDIDOS (PÚBLICO) ---
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

// --- AUTENTICAÇÃO ---
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}

// No seu web.php, mude o grupo para:
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [MusicianSongController::class, 'dashboard'])->name('musician.dashboard');
    // No web.php, dentro do group(['middleware' => 'auth'])
Route::post('/orders/{id}/complete', [MusicianSongController::class, 'completeOrder'])->name('orders.complete');

    // Remova o prefixo 'dashboard/' se quiser testar direto, 
    // ou garanta que o controller aceite o slug:
    Route::get('/dashboard/{slug}/painel-repertorio', [MusicianSongController::class, 'index'])->name('musician.songs.index');
    Route::post('/dashboard/{slug}/painel-repertorio', [MusicianSongController::class, 'store'])->name('musician.songs.store');
});

// No seu web.php, dentro do grupo auth
Route::delete('/dashboard/{slug}/painel-repertorio/{id}', [MusicianSongController::class, 'destroy'])->name('musician.songs.destroy');

// --- PERFIL PÚBLICO (Sempre por último) ---
Route::get('/{slug}', [MusicianController::class, 'show'])->name('musician.show');

Route::post('/notifications/subscribe', [PushSubscriptionController::class, 'subscribe'])
    ->name('notifications.subscribe');