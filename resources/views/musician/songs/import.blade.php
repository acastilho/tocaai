@extends('layouts.tocaai')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            
            <div class="mb-5 text-center">
                <h2 class="text-white fw-black uppercase italic m-0" style="font-size: 2rem; letter-spacing: -1px;">
                    IMPORTAR <span class="text-coral">LISTA</span>
                </h2>
                <p class="text-secondary small uppercase tracking-widest mt-2">Cole seu repertório abaixo</p>
            </div>

            <form action="{{ route('musician.songs.import.store', $musician->slug) }}" method="POST">
                @csrf
                <div class="p-4 mb-4" style="background: #111; border: 1px solid #222; border-radius: 32px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
                    <label class="text-secondary small fw-bold mb-3 d-block uppercase tracking-tighter">Uma música por linha:</label>
                    <textarea 
                        name="content" 
                        rows="12" 
                        class="form-control bg-transparent text-white border-0 shadow-none p-0" 
                        placeholder="Exemplo:&#10;Evidências&#10;Boate Azul&#10;Garçom"
                        style="resize: none; font-family: 'Courier New', monospace; font-size: 14px; line-height: 1.6;"
                        required></textarea>
                </div>

                <div class="d-flex justify-content-between align-items-center px-2">
                    <a href="{{ route('musician.songs.index', $musician->slug) }}" class="text-secondary small fw-black text-uppercase text-decoration-none hover-coral">
                        <i class="bi bi-arrow-left me-1"></i> Voltar
                    </a>
                    <button type="submit" class="btn btn-coral rounded-pill px-5 py-2 fw-black uppercase italic shadow-lg">
                        Salvar Repertório
                    </button>
                </div>
            </form>

            <div class="mt-5 p-4 rounded-4 border border-dark opacity-50">
                <h6 class="text-white small fw-bold uppercase mb-2"><i class="bi bi-lightbulb text-coral me-2"></i>Dica do TocaAí</h6>
                <p class="text-secondary mb-0" style="font-size: 11px;">
                    Você pode copiar sua lista do WhatsApp, Bloco de Notas ou Word e colar direto aqui. O sistema remove linhas em branco automaticamente.
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    .text-coral { color: #FF4757; }
    .btn-coral { background: #FF4757; color: #fff; border: none; transition: all 0.3s; }
    .btn-coral:hover { background: #ff6b81; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(255, 71, 87, 0.4); }
    .form-control::placeholder { color: #333; }
    .hover-coral:hover { color: #FF4757 !important; }
</style>
@endsection