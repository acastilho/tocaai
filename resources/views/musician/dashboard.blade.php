@extends('layouts.tocaai')

@section('title', 'Painel do Cantor - TocaAí')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-white">Palco de <span style="color: #FF4757;">{{ $musician->name }}</span></h1>
            <p class="text-secondary">Gerencie seus pedidos e seu repertório</p>
        </div>
        <a href="{{ route('musician.show', $musician->slug) }}" class="btn btn-outline-light rounded-pill px-4" target="_blank">
            <i class="bi bi-eye me-2"></i>Ver Perfil Público
        </a>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <h4 class="text-white mb-3">Pedidos Pendentes</h4>
            @if($orders->where('status', 'pending')->isEmpty())
                <div class="card card-tocaai p-5 text-center border-0" style="background: #161616; border-radius: 20px;">
                    <i class="bi bi-music-note-beamed text-secondary display-1 mb-3"></i>
                    <p class="text-secondary">Nenhum pedido pendente.</p>
                </div>
            @else
                @foreach($orders->where('status', 'pending') as $order)
                <div class="card card-tocaai mb-3 border-0 shadow-sm" style="background: #161616; border-radius: 15px; border-left: 4px solid #FF4757 !important;">
                    <div class="card-body d-flex justify-content-between align-items-center p-4">
                        <div>
                            <h5 class="text-white mb-1">{{ $order->client_name }}</h5>
                            <p class="text-secondary mb-0">Música: <span class="text-white fw-bold">{{ $order->song->title ?? '---' }}</span></p>
                        </div>
                        <div class="text-end">
                            <span class="d-block text-coral fw-bold h4 mb-2">R$ {{ number_format($order->amount, 2, ',', '.') }}</span>
                            <form action="{{ route('orders.complete', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success rounded-pill px-4 fw-bold">CONCLUIR</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>

        <div class="col-md-4">
            <div class="card card-tocaai p-4 border-0" style="background: #161616; border-radius: 20px;">
                <h5 class="text-white mb-3">Link do Perfil</h5>
                <input type="text" class="form-control bg-dark border-secondary text-secondary mb-3" value="{{ route('musician.show', $musician->slug) }}" readonly>
                <a href="{{ route('musician.songs.index', $musician->slug) }}" class="btn btn-outline-coral w-100 rounded-pill">
                    Editar Repertório
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .text-coral { color: #FF4757; }
    .btn-outline-coral { border: 1px solid #FF4757; color: #FF4757; }
    .btn-outline-coral:hover { background: #FF4757; color: white; }
</style>
@endsection
