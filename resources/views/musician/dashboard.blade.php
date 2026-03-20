@extends('layouts.tocaai')

@section('title', 'Painel do Cantor - TocaAí')

@section('content')
<div class="container py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-5 border-bottom border-dark pb-3">
        <div>
            <h1 class="fw-black text-white uppercase italic m-0" style="font-size: 1.5rem; letter-spacing: -1px;">
                PALCO: <span style="color: #FF4757;">{{ $musician->name }}</span>
            </h1>
        </div>
        
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-dark btn-sm rounded-pill px-4 border-secondary text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 1px;">
                <i class="bi bi-box-arrow-right me-1"></i> Sair
            </button>
        </form>
    </div>

    <div class="row g-4">
        
        <div class="col-12 col-lg-4">
            <div class="card-tocaai p-4 text-center h-100 shadow-lg" style="background: #111; border: 1px solid #222; border-radius: 32px;">
                <span class="text-secondary text-uppercase fw-bold mb-3 d-block" style="font-size: 10px; letter-spacing: 2px;">Seu Link de Pedidos</span>
                
                @if(isset($musician->slug))
                    <div class="bg-white p-3 rounded-4 d-inline-block border border-5 border-coral mb-3">
                        {{-- Fallback de segurança para o QR Code --}}
                        @if(class_exists('SimpleSoftwareIO\QrCode\Facades\QrCode'))
                            {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(160)->generate(route('musician.show', $musician->slug)) !!}
                        @else
                            <img src="https://chart.googleapis.com/chart?chs=160x160&cht=qr&chl={{ urlencode(route('musician.show', $musician->slug)) }}&choe=UTF-8" alt="QR Code">
                        @endif
                    </div>
                    
                    <div class="px-3 mb-4">
                        <a href="{{ route('musician.show', $musician->slug) }}" target="_blank" class="btn btn-coral w-100 rounded-pill fw-black uppercase italic py-2 shadow-sm" style="font-size: 12px;">
                            <i class="bi bi-eye-fill me-2"></i> Visualizar Perfil
                        </a>
                        <small class="text-secondary d-block mt-2 italic" style="font-size: 10px;">tocaai.com/{{ $musician->slug }}</small>
                    </div>
                @endif

                <hr class="border-secondary opacity-25 mb-4">

                <a href="{{ route('musician.songs.index', $musician->slug) }}" class="btn btn-outline-light w-100 rounded-pill fw-bold btn-sm opacity-75 hover-opacity-100">
                    GERENCIAR REPERTÓRIO
                </a>
                <hr class="border-secondary opacity-25 mb-4">

<div class="d-grid gap-2">
    <a href="{{ route('musician.songs.index', $musician->slug) }}" class="btn btn-outline-light rounded-pill fw-bold btn-sm opacity-75 hover-opacity-100">
        <i class="bi bi-list-ul me-2"></i> VER REPERTÓRIO
    </a>
    
    <a href="{{ route('musician.songs.import', $musician->slug) }}" class="btn btn-dark rounded-pill fw-bold btn-sm border-secondary mt-2">
        <i class="bi bi-box-arrow-in-down me-2"></i> IMPORTAR LISTA
    </a>
</div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card-tocaai p-4 h-100" style="background: #111; border: 1px solid #222; border-radius: 32px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="text-white fw-black uppercase italic m-0" style="font-size: 1.1rem;">
                        Fila de Pedidos
                        <span class="ms-2 spinner-grow spinner-grow-sm text-coral" role="status" style="width: 8px; height: 8px; animation-duration: 2s;"></span>
                    </h4>
                    <span class="badge rounded-pill bg-coral px-3">{{ $orders->where('status', 'pending')->count() }}</span>
                </div>

                <div class="overflow-auto" style="max-height: 450px;">
                    @if($orders->where('status', 'pending')->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-music-note text-secondary fs-1 opacity-25"></i>
                            <p class="text-secondary small mt-2 uppercase fw-bold tracking-widest">Silêncio no palco...</p>
                        </div>
                    @else
                        @foreach($orders->where('status', 'pending') as $order)
                        <div class="d-flex justify-content-between align-items-center p-3 mb-2 shadow-sm" style="background: #161616; border-radius: 16px; border-left: 4px solid #FF4757;">
                            <div>
                                <h6 class="text-white fw-bold mb-0">{{ $order->client_name }}</h6>
                                <small class="text-secondary italic uppercase font-bold" style="font-size: 10px;">{{ $order->song->title ?? 'Música solicitada' }}</small>
                            </div>
                            <div class="text-end">
                                <span class="d-block text-coral fw-bold mb-2">R$ {{ number_format($order->amount, 2, ',', '.') }}</span>
                                
                                <form action="{{ route('orders.complete', $order->id) }}" method="POST" id="form-order-{{ $order->id }}" class="m-0">
                                    @csrf
                                    <button type="button" 
                                            onclick="agradecerETocar('{{ $order->id }}', '{{ addslashes($order->song->title ?? 'música') }}', '{{ addslashes($order->client_name) }}')" 
                                            class="btn btn-sm btn-light rounded-pill px-3 fw-black uppercase italic" style="font-size: 10px;">
                                        Tocar
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

<script>
/**
 * Voz AI e Conclusão de Pedido
 */
function agradecerETocar(orderId, musica, cliente) {
    const texto = `Obrigado pelo pedido, ${cliente}! Vou tocar agora a música ${musica}. Toca aí!`;
    const msg = new SpeechSynthesisUtterance();
    msg.text = texto;
    msg.lang = 'pt-BR';
    msg.rate = 1.1;

    msg.onend = function() {
        document.getElementById('form-order-' + orderId).submit();
    };

    msg.onerror = function() {
        document.getElementById('form-order-' + orderId).submit();
    };

    window.speechSynthesis.speak(msg);
}

/**
 * Auto-Refresh Seguro (20s)
 */
let refreshTimeout = setTimeout(function atualizarFila() {
    if (!window.speechSynthesis.speaking) {
        window.location.reload();
    } else {
        setTimeout(atualizarFila, 5000);
    }
}, 20000);
</script>

<style>
    body { background-color: #000 !important; }
    .text-coral { color: #FF4757 !important; }
    .bg-coral { background-color: #FF4757 !important; }
    .btn-coral { background-color: #FF4757 !important; color: white !important; border: none; }
    .border-coral { border-color: #FF4757 !important; }
    .fw-black { font-weight: 900; }
    .italic { font-style: italic; }
    
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: #111; }
    ::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #FF4757; }
</style>
@endsection