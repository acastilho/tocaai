<?php

use Illuminate\Support\Facades\Route;
use App\Models\Musician;
use App\Http\Controllers\MusicianSongController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MusicianRegistrationController;
use Illuminate\Support\Facades\Artisan;

// --- ROTAS PÚBLICAS (Acesso Livre) ---


Route::get('/prepare-db', function () {
	    try {
		            // 1. Cria a tabela de sessões (se não existir)
         Artisan::call('session:table');
                 
                         // 2. Roda as migrations
                                 Artisan::call('migrate', ['--force' => true]);
                                       
                                             return "Banco de dados preparado com sucesso!";
                                                     } catch (\Exception $e) {
                                                             return "Erro ao preparar banco: " . $e->getMessage();
                                                                 }
                                                                 });
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Cadastro de Músico (Agora fora do Auth para o botão funcionar direto)
Route::get('/register-musician', [MusicianRegistrationController::class, 'create'])->name('musician.register.create');
Route::post('/register-musician', [MusicianRegistrationController::class, 'store'])->name('musician.register.store');

// Processamento de Pedidos
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

// Carrega as rotas de autenticação padrão do Laravel (Login, Register, etc)
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}

// --- ROTAS PROTEGIDAS (Exigem Login) ---

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [MusicianSongController::class, 'dashboard'])->name('musician.dashboard');

    // Gerenciamento de Repertório dentro do Painel
    Route::prefix('dashboard/{slug}')->group(function () {
        Route::get('/painel-repertorio', [MusicianSongController::class, 'index'])->name('musician.songs.index');
        Route::post('/painel-repertorio', [MusicianSongController::class, 'store'])->name('musician.songs.store');
        Route::delete('/painel-repertorio/{id}', [MusicianSongController::class, 'destroy'])->name('musician.songs.destroy');
        Route::post('/pix', [MusicianSongController::class, 'updatePix'])->name('musician.pix.update');
    });
});

// --- PERFIL PÚBLICO (Sempre por último) ---

Route::get('/{slug}', function ($slug) {
    $musician = Musician::where('slug', $slug)->firstOrFail();
    return view('musician.show', compact('musician'));
})->name('musician.show');

// Rota para concluir o pedido
 Route::post('/orders/{id}/complete', [App\Http\Controllers\OrderController::class, 'complete'])->name('orders.complete')->middleware('auth');




