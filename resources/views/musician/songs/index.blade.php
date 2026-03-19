@extends('layouts.tocaai')

@section('title', 'Gerenciar Repertório - TocaAí')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-black text-white uppercase italic tracking-tighter">Meu <span style="color: #FF4757;">Repertório</span></h1>
            <p class="text-secondary small uppercase fw-bold tracking-widest">Adicione ou remova as músicas que você toca</p>
        </div>
        <a href="{{ route('musician.dashboard', $musician->slug) }}" class="btn btn-outline-light rounded-pill px-4 text-[10px] fw-bold">
            <i class="bi bi-arrow-left me-2"></i>VOLTAR AO PAINEL
        </a>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 p-4" style="background: #161616; border-radius: 24px; border: 1px solid #222 !important;">
                <h5 class="text-white fw-bold mb-4">Nova Música</h5>
                <form action="{{ route('musician.songs.store', $musician->slug) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="text-secondary small fw-bold uppercase mb-2 d-block">Título da Música</label>
                        <input type="text" name="title" class="form-control bg-black border-secondary text-white py-3 rounded-3" placeholder="Ex: Evidências" required>
                    </div>
                    <div class="mb-4">
                        <label class="text-secondary small fw-bold uppercase mb-2 d-block">Artista / Banda</label>
                        <input type="text" name="artist" class="form-control bg-black border-secondary text-white py-3 rounded-3" placeholder="Ex: Chitãozinho & Xororó">
                    </div>
                    <button type="submit" class="btn w-100 py-3 fw-black uppercase italic" style="background: #FF4757; color: white; border-radius: 15px;">
                        ADICIONAR À LISTA
                    </button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0" style="background: #161616; border-radius: 24px; border: 1px solid #222 !important; overflow: hidden;">
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0 align-middle">
                        <thead style="background: #1a1a1a;">
                            <tr>
                                <th class="px-4 py-3 border-0 text-secondary small fw-bold uppercase">Música</th>
                                <th class="px-4 py-3 border-0 text-secondary small fw-bold uppercase text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($musician->songs as $song)
                                <tr style="border-bottom: 1px solid #222;">
                                    <td class="px-4 py-4">
                                        <div class="fw-bold text-white">{{ $song->title }}</div>
                                        <div class="text-secondary small uppercase fw-bold" style="font-size: 10px;">{{ $song->artist ?? 'Artista não informado' }}</div>
                                    </td>
                                    <td class="px-4 py-4 text-end">
                                        <form action="{{ route('musician.songs.destroy', [$musician->slug, $song->id]) }}" method="POST" onsubmit="return confirm('Remover esta música?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center py-5 text-secondary">
                                        Seu repertório ainda está vazio.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        background-color: #000 !important;
        border-color: #FF4757 !important;
        box-shadow: none !important;
        color: white !important;
    }
    .table-hover tbody tr:hover {
        background-color: #1a1a1a !important;
    }
</style>
@endsection
